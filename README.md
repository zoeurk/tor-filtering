# Filtering The Network Coming From Tor
## Configure your firewall (I use nftables)
We need to create a rules like:  
iifname $interface ct state new tcp dport 80 log prefix "Services User: " flags all  
Of course you can simply drop it, or redirect it to another service.  
  
## Configure your logs
For have a separate log for this rule we need to configure rsyslog  
Somthing like that work for me:  
msg,contains,"Services user:"
*.* /var/log/nftables-tor-access.log

## codes
I give you somthing to try  
You should modify it (you are free to share, modify, redistribute, ...).  
You can integrate it on your site.  
Maybe Developpers, systems administrators (,...)  
have to discuss this among themselves.  


