AppGlobal = {}
AppGlobal.debugMode = true
AppGlobal.initialize = function(page){
  $.ajaxSetup({
  	headers: {
  		'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
  	}
  })
  page.repo = {}
  var repo = $('#repo');
  if(repo.length>0){
    repo.children('div').each(function(){
      var classname = $(this).attr('class')
      if(classname==null){
        return;
      }
      if(classname.trim()!=''){
        page.repo[classname] = $(this).html().trim();
      }
    })
  }

  var storedNotification = AppGlobal.storage.get();
  for(var i = 0; i<storedNotification.length; i++){
    AppGlobal.postMessage(storedNotification[i].type,storedNotification[i].text);
  }
  AppGlobal.storage.delete();
}
AppGlobal.closeNotification = function(event,element){
  $(element).parent().remove();
}
AppGlobal.storage = {
  initialize: function(){
    if(window.localStorage.kkmsg == null){
      window.localStorage.kkmsg = '[]'
    }
  },
  load: function(){
    this.initialize();
    return JSON.parse(window.localStorage.kkmsg)
  },
  save: function(obj){
    window.localStorage.kkmsg = JSON.stringify(obj)
  },
  store: function(type,text){
    var storage = this.get();
    storage.push({type:type,text:text});
    this.save(storage);
  },
  get: function(){
    var storage = this.load()
    return storage;
  },
  delete: function(){
    window.localStorage.kkmsg = JSON.stringify([])
  }
}
AppGlobal.template = function(type,message){
  var ret = ""
  ret += "<div class='alert alert-"+type+"'>"
  ret += '<a class="close" onclick="AppGlobal.closeNotification(event,this)">&times;</a>'
  ret += "<strong>"+type[0].toUpperCase()+type.substr(1)+"! </strong>"
  ret += "<span>"+message+"</span>"
  ret += "</div>"
  return ret;
}
AppGlobal.postMessage = function(type,message){
  $('#globalmessage').append(AppGlobal.template(type,message));
}
AppGlobal.ajax = {}
AppGlobal.ajax.ajaxSuccess = function(data){
  AppGlobal.postMessage('success',data.message)
}
AppGlobal.ajax.ajaxError = function(data){
  AppGlobal.postMessage('warning',data.message)
}
AppGlobal.ajax.html = function(object){
  if(typeof object.data == 'object'){
    object.data.csrf_token = $('meta[name="csrf_token"]').attr('content');
  }
  $.ajax({
    url: object.url,
    data: object.data,
    method: object.method,
    success: function(data){
      if(AppGlobal.debugMode){
        if(typeof data == 'string'){
          AppGlobal.postMessage('info',data)
        }
        else{
          console.info(data)
        }
      }
      if(data.status == 1){
        object.success(data)
      }else{
        if(AppGlobal.debugMode){
          AppGlobal.postMessage('danger',data.stackTrace)
          console.warn(data)
        }
        if(object.error){
          object.error(data)
        }
      }
    },
    error: function(e){
      if(AppGlobal.debugMode){
        console.error(e)
        AppGlobal.postMessage('danger',e.responseText)
      }
      else{
        AppGlobal.postMessage('danger','Terjadi kesalahan pada sistem')
      }
    }
  })
}
AppGlobal.ajax.json = function(object){
  if(typeof object.data == 'object'){
    object.data.csrf_token = $('meta[name="csrf_token"]').attr('content');
  }
  $.ajax({
    url: object.url,
    data: object.data,
    method: object.method,
    success: function(data){
      if(AppGlobal.debugMode){
        if(typeof data == 'string'){
          AppGlobal.postMessage('info',data)
        }
        else{
          console.info(data)
        }
      }
      data = JSON.parse(data)
      if(data.status == 1){
        object.success(data)
      }else{
        if(AppGlobal.debugMode){
          AppGlobal.postMessage('danger',data.stackTrace)
          console.warn(data)
        }
        if(object.error){
          object.error(data)
        }
      }
    },
    error: function(e){
      if(AppGlobal.debugMode){
        console.error(e)
        AppGlobal.postMessage('danger',e.responseText)
      }
      else{
        AppGlobal.postMessage('danger','Terjadi kesalahan pada sistem')
      }
    }
  })
}
AppGlobal.sorter = {}
AppGlobal.sorter.paginate = function(table,pageNoSpawner){
  var i = 0;
  var j = 1;
  var max = $(table).data('maxitem')
  if(!max){
    $(table).data('maxitem',10)
    max = 10;
  }
  $(table).find('tbody tr').each(function(){
    $(this).attr('data-page',j)
    if(j==1){
      $(this).show();
    }
    else{
      $(this).hide();
    }
    i++
    if(i>=max){
      j++
      i=0
    }
  })
  table.pageNo = j
  if(pageNoSpawner){
    table.pageNoSpawner = pageNoSpawner
  }
  if(table.pageNoSpawner){
    table.pageNoSpawner(table.pageNo,1)
  }
  table.paginated = true
  table.switchPage = function(e,pageno){
    e.preventDefault();
    AppGlobal.sorter.switchPage(table,pageno)
  }
}
AppGlobal.sorter.switchPage = function(table,i){
  $(table).find('tbody tr').hide();
  $(table).find('tbody tr[data-page='+i+']').show();
  if(table.pageNoSpawner){
    table.pageNoSpawner(table.pageNo,i)
  }
}
AppGlobal.sorter.activate = function(table){
  $(table).find('thead th[data-sorter]').addClass('clickable').click(function(){
    AppGlobal.sorter.sort(this,table)
  }).attr('title','Klik untuk melakukan sortir')
}
AppGlobal.sorter.sort = function(th,table){
  var attribute = $(th).data('sorter')
  $(table).find('tbody tr').each(function(){
    var value = $(this).find('td[data-sorter="'+attribute+'"]').data('ori')
    $(this).data('ori',value)
  })

  var desc = false
  var lastAttribute = $(table).data('lastAttribute');
  var lastDirection = $(table).data('lastDirection');
  if(lastAttribute == attribute){
    desc = 'true'!=String(lastDirection)
  }
  $(table).data('lastAttribute',attribute)
  $(table).data('lastDirection',String(desc))

  var trs = $(table).find('tbody tr')
  trs.detach().sort(function(a,b){
    var va = $(a).data('ori')
    var vb = $(b).data('ori')
    var comparator
    if(va>vb){
      comparator = 1
    }else if(va<vb){
      comparator = -1
    }
    else{
      comparator = 0
    }
    return comparator * (desc ? -1 : 1)
  }).appendTo($(table).find('tbody'))
  if(table.paginated){
    AppGlobal.sorter.paginate(table)
  }
}
