<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" type="text/css" href="css.css">
  </head>
  <body onload="properDate()">
    <h1>Crawler</h1>
    Time until next automatic research - <p id="demo" ></p>
<hr>
<span class = "incomeTicker" id = "incomeTicker" > </span>
    <table>
      <tr>
        <td><form  method="post" action="./insert_site.php">
          Add site <input type="text" name="check_site" required>
          <input type="submit" value="Add">
        </form></td>
      </tr>
      <tr>
        <td><form  method="get" action="./get_sites.php">
          <input type="submit" value="Check all sites">
        </form></td>

      </tr>
      <tr>
        <td><form  method="post" action="./insert_link.php">
          Add link <input type="text" name="check_link" required>
          <input type="submit" value="Add">
        </form></td>

      </tr>
      <tr>
        <td>  <form  method="get" action="./get_links.php">
            <input type="submit" value="Check all links">
          </form></td>
      </tr>
      <tr>
        <td>  <form  method="post" action="./crawler.php" id="crawler">
          Crawler <input type="text" name="email" required>
          <input type="submit" value="Do research now" >
        </form></td>
      </tr>
    </table>

  </body>
</html>

<script>

var countDownDate = new Date("Feb 22, 2019 13:15:10");
var now = new Date();

function properDate() {
  while(now.getTime() - countDownDate.getTime() > 0)
  {
    countDownDate.setDate(countDownDate.getDate() + 1);
  }
}

var x = setInterval(function() {
  var distance = countDownDate - now;

  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("demo").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";

  if (distance < 0) {
    countDownDate.setDate(countDownDate.getDate() + 1);
    document.getElementById('crawler').submit();
    document.getElementById("demo").innerHTML = "Starting research. Timer will reset.";
  }
}, 1000);
</script>
