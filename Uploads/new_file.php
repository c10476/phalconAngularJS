server
	{
		listen 80;
		#listen [::]:80;
		server_name colipu.wwlm360.com colipu.wwlm360.com;
		index index.html index.htm index.php default.html default.htm default.php;
		set $root_path  /home/wwwroot/colipu.wwlm360.com/public;
                  root $root_path;

		include colipu.wwlm360.com.conf;
		#error_page   404   /404.html;

        
    location ~* ^/(css|img|js|flv|swf|download)/(.+)$ {
        root $root_path;
    }
 
     location ~ .*/files/.*\.(css|img|js|flv|swf|)$ {
			    root $root_path/files/;
			}
    #try_files $uri $uri/ @rewrite;
    try_files $uri $uri/ /index.php?_url=$uri&$args;
    location @rewrite {
       rewrite ^/(.*)$ /index.php?_url=$1;
    }
    
    location ~ \.php {
        # try_files $uri =404;
        fastcgi_index /index.php;
      
        				try_files $uri =404;
				fastcgi_pass  unix:/tmp/php-cgi.sock;
				fastcgi_index index.php;
				include fastcgi.conf;
				#include pathinfo.conf;
    }

    location ~ /\.ht {
        deny all;
    }

		access_log  /home/wwwlogs/colipu.wwlm360.com.log  access;
	}
