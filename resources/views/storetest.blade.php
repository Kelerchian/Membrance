<!DOCTYPE html>
<html>
<head>
  <script src="{{ url('script/vile.js') }}"></script>
  <style>
  .alert{
    color: yellow;
  }
  div>input{
    display: block;
    width: 300px;
  }
  </style>
</head>
<body>
  @if( isset($status) )
  {{ $status }}

  @endif

  <form method='post' action="{{ url('/storetest') }}">
    {!! csrf_field() !!}
    <input type='text' name='type' placeholder="class" required />
    <input type='text' name='name' placeholder="name" required/>
    <br />
    <br />
    <div>
      <input type='number' name='prop[umur]' placeholder="Umur" required/>
      <input type='text' name='prop[tempat lahir]' placeholder="Tempat Lahir" required/>
      <input type='date' name='prop[tanggal lahir]' placeholder="Tanggal Lahir" required/>
    </div>
    <input type='submit'/>
  </form>
</body>
</html>

<script>
</script>
