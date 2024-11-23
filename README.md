# Filtering The Network Coming From Tor
Before continuing read try this "_https://github.com/zoeurk/tor-filtering/tree/main_"  

## Configure your firewall (I use nftables)
We need to create a rules like:  
chain TOR {  
&emsp;ct original bytes != 60 counter packets 0 bytes 0 log prefix "[NetFilter] Tor User: " flags all  
&emsp;ct count over 1 counter packets 0 bytes 0 log prefix "[NetFilter] Tor User: " flags all  
}  
iifname $interface ct state new tcp dport 80 jump TOR  
Of course you can simply drop(, reject) it, or redirect it to another service.  
  
## Configure your logs
For have a separate log for this rule we need to configure rsyslog  
Somthing like that work for me:  
msg,contains,"Tor User:"
*.* /var/log/tor-access.log

## codes
I give you somthing to try  
You should modify it (you are free to share, modify, redistribute, ...).  
You can integrate it on your site.  
Maybe Developpers, systems administrators (,...)  
have to discuss this among themselves.  

