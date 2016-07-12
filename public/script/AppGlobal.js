AppGlobal = {}
AppGlobal.debugMode = true
AppGlobal.initialize = function(page){
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
AppGlobal.ajax.jsonError = function(data){
  AppGlobal.postMessage('warning',data.message)
}
AppGlobal.ajax.html = function(object){
  $.ajax({
    url: object.url,
    data: object.data,
    method: object.method,
    success: function(data){
      if(data.success == 1){
        console.info(data)
        object.success(data)
      }else{
        if(AppGlobal.debugMode){
          console.warn(e)
        }
        if(object.error){
          object.error(data)
        }
      }
    },
    error: function(e){
      if(AppGlobal.debugMode){
        console.error(e)
      }
      AppGlobal.postMessage('error',e.message)
    }
  })
}
AppGlobal.ajax.json = function(object){
  $.ajax({
    url: object.url,
    data: object.data,
    method: object.method,
    success: function(data){
      data = JSON.parse(data)
      if(data.success == 1){
        console.info(data)
        object.success(data)
      }else{
        if(AppGlobal.debugMode){
          console.warn(e)
        }
        if(object.error){
          object.error(data)
        }
      }
    },
    error: function(e){
      if(AppGlobal.debugMode){
        console.error(e)
      }
      AppGlobal.postMessage('error',e.message)
    }
  })
}
