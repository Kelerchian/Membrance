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
    console.log(storage)
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
        AppGLobal.postMessage('danger','Terjadi kesalahan pada sistem')
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
        AppGLobal.postMessage('danger','Terjadi kesalahan pada sistem')
      }
    }
  })
}
