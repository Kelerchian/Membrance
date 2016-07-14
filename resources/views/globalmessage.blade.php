<div id="globalmessage" class='container' vile-weave='globalmessage'>
	@if(session()->has('errors') && count(session('errors'))>0)
    @foreach(session('errors') as $error)
      <div class='alert alert-danger'>
        <a class='close' onclick="AppGlobal.closeNotification(event,this)">&times;</a>
        <strong>Danger!</strong>
        <span>{{ $error }}</span>
      </div>
    @endforeach
	@endif
  <!--div class='alert alert-success'>
    <a class='close' onclick="AppGlobal.closeNotification(event,this)">&times;</a>
    <strong>Success!</strong>
    <span>Test</span>
  </div>
  <div class='alert alert-info'>
    <a class='close' onclick="AppGlobal.closeNotification(event,this)">&times;</a>
    <strong>Info!</strong>
    <span>Test</span>
  </div>
  <div class='alert alert-warning'>
    <a class='close' onclick="AppGlobal.closeNotification(event,this)">&times;</a>
    <strong>Warning!</strong>
    <span>Test</span>
  </div>
  <div class='alert alert-danger'>
    <a class='close' onclick="AppGlobal.closeNotification(event,this)">&times;</a>
    <strong>Danger!</strong>
    <span>Test</span>
  </div-->
</div>
