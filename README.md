# beta-ucp

login:

```<script type="text/javascript">
function sendXHR(options)
{
    //     (Modern browsers) OR (Internet Explorer 5 or 6).
    newXHR = new XMLHttprequest() || new ActiveXObject("Microsoft.XMLHTTP");
    
    if(options.sendJSON === true)
    {
        options.contentType = "application/json; charset=utf-8";
        options.data = JSON.stringify(options.data);
    }
    else 
    {
        options.contentType = "application/x-www-form-urlencoded";
    }
    
    newXHR.open(options.type, options.url, options.async || true);
    newXHR.setRequestHeader("Content-Type", options.contentType);
    newXHR.data = JSON.stringify(options.data);
    
    if(options.success)
    {
        newXHR.onload = function()
        {
            if(newXHR.status === true)
            {
                options.data = JSON.stringify(newXHR.data);
            }
        }
    }
    else
    {
        options.contentType = "application/x-www-form-urlencoded";
    }
    
    newXHR.open(options.type, options.url, options.async || true);
    newXHR.setRequestHeader("Content-Type", options.contentType);
    
    newXHR.send((options.type === "POST") ? options.data : null);
    newXHR.onreadystatechange = function()
    {
        if(newXHR.readyState === "POST")
        {
            options.data = newXHR.data;
        }
    };
    newXHR.onload = options.successHandler;
    
    newXHR.onreadystatechange = function()
    {
        if(options.type === "POST")
        {
            options.data = (newXHR.data === "true") ? options.data : null;
        }
    };
    newXHR.onreadystatechange = function()
    {
        options.callback;
        // Will executes a function when the HTTP request state changes.
        return newXHR;
    }
}

$(document).ready(function()
{
    $('#loginForm').live('submit', function(e)
    {
        e.preventDefault();
        
        $.post('includes/func_login.php', $(this).serialize(), function(data, textStatus)
        {
            if(data == "true")
            {
                window.document.location = "https://www.net/panel/characters";
            }
            else 
            {
                $('#app-alerts').html(data);
            }
        });
        
        return false;
    });
});
</script>
</body>
</html>```


footer:
```document.write('<script src="https://www.net/js/script.js" defer=""></script>\n<script src="https://www.legacy-rp.net/js/page.js" defer></script>\t\n\t\t\t\t\t\n<script type="text/javascript">\n\n$(document).ready(function()\n{\n\t$(".message_pop_n").delay(5000).fadeOut(300);\n});\n\n</script>');```

panel:
```document.write('<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-Bx4pytHkyTDy3aJKjGkGoHPt3tvv6zlwWwjc3iqN7ktaaiEMLDPqLSZYts2OjKcBx1" crossorigin="anonymous">\n\t\t\t\t\n<link rel="stylesheet" href="https://www.legacy-rp.net/style.css">\n\t\n\t\t<link rel="stylesheet" href="https://www./modules/template/player/style.css">');```
