# MultiServerCounter
A PocketMine-MP plugin that combines online players counts of multiple servers.

This is useful e.g. when you have a lobby server and other gamemodes on different servers, and you want the lobby server to display  the number of players of all the servers, combined, when queried from a server list or the menu in the MCBE client.

**How to use:**
- Drop the phar in the plugins folder
- Restart the server
- Edit the config.yml found in plugins_data/MultiServerCounter and add the server you want to query
- Save the file and restart the server

**config.yml**

```
---
#Time in seconds
update-players-interval: 30

#Format: "ip:port"
servers-to-query:
- "127.0.0.1:19133"
- "127.0.0.1:19134"
...
```
