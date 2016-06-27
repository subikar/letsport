<html>
<head>
<title>Welcome To iTCSLive Admin</title>
<link rel="stylesheet" type="text/css" href="templates/itcslive/css/style.css" />
</head>
<body>
<div class="totalwrap_landing">
  <div class="topheaderlanding">
    <a href=""><div class="landinglogo"></div></a>
    <div class="clear"></div>
  </div>
  <div class="loginform">
    <div id="system-message-container"> </div>
    <form  action="" method="post" name="loginform">
      <div class="fieldarea">
        <p class="field_title">Email</p>
        <p class="field_input">
          <input type="text" requred="true" class="boxinputbig" placeholder="Enter Email" name="email">
        </p>
        <div class="clear"></div>
      </div>
      <div class="fieldarea">
        <p class="field_title">Password</p>
        <p class="field_input">
          <input type="password" requred="true" class="boxinputbig" placeholder="Enter Password" name="password">
        </p>
        <div class="clear"></div>
      </div>
      <div class="fieldarea fieldarea_password">
        <p class="field_title"></p>       
        <div class="clear"></div>
      </div>
      <div class="login_btns">
        <input type="submit" value="Login" name="submit">
        <input type="hidden" value="login" name="view">
        <input type="hidden" value="checklogin" name="task">
        <div class="clear"></div>
      </div>      
    </form>
    <div class="clear"></div>
  </div>
</div>
</body>
</html>