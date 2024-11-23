# Filtering The Network Coming From Tor
Before continuing read try this "_https://github.com/zoeurk/tor-filtering/tree/main_"  

## Configure your firewall (I use nftables)
We need to create a rules like:  
iifname $interface ct state new tcp dport 80 log prefix "Services User: " flags all  
Of course you can simply drop it, or redirect it to another service.  
  
## Configure your logs
For have a separate log for this rule we need to configure rsyslog  
Somthing like that work for me:  
msg,contains,"Services user:"
*.* /var/log/tor-access.log

## codes
I give you somthing to try  
You should modify it (you are free to share, modify, redistribute, ...).  
You can integrate it on your site.  
Maybe Developpers, systems administrators (,...)  
have to discuss this among themselves.  

P.S:&emsp;Maybe you have to test if the user have access to an hidden service...  
&ensp;&emsp;&emsp; Or see if they are more than 1 packet before connecting to your service...  

Something like that can maybe help you (but the trafic coming from an exit node is redirected to my onion):  
iifname $interface tcp dport 80 ct original packets > 5 log prefix "[NetFilter] Normal User: " flags all  
