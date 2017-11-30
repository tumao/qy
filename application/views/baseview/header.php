<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link href="/static/css/calendar.css" rel="stylesheet" type="text/css"/>
    <link href="/static/css/web2py.css" rel="stylesheet" type="text/css"/>
    <link href="/static/css/stupid.css" rel="stylesheet" type="text/css"/>
    <link href="/static/css/examples.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <link rel="shortcut icon" href="" type="image/x-icon"> -->
    <!-- <link rel="apple-touch-icon" href="{{=URL('static','images/favicon.png')}}"> -->
   
     <!--<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script type="text/javascript" src="/static/js/jquery.js"></script>
  </head>
  <body class="black">   
    <header class="black padded">      
      <div class="container middle max900">
        <div class="fill middle">                    
          <label class="ham" for="menu"><i class="fa fa-bars padded"></i></label>
          <div class="burger accordion">
            <input type="checkbox" id="menu"/>
            <!-- {{=MENU(response.menu,_class='menu')}} -->
            <ul class='menu'>
              <li><a href="/">首页</a></li>
              <li><a href="/data">数据</a></li>
              <li><a href="/">关于</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <div cla<!-- ss="w2p_flash">
    </div> 
    <main class="white">
      <div class="container max900">
      
    
