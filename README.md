#Configuration


If you'd like to gather more data than you can use custom data provider by adding specific infos
```
dashboard:
  infos:
     - 'Evrinoma\DashBoardBundle\Info\ProcInfo'
     - 'Evrinoma\DashBoardBundle\Info\SysInfo'
```

if you'd like to use a special handler
```
  provider: App\DashBoard\Provider\DashBoardProvider<br>
```

Override base menu
```
dashboard:
  menu: App\Menu\DashBoardMenu
```

or register new instance in service.yml file
```
App\Menu\DashBoardMenu:
  tags:
    - { name: evrinoma.menu }
```
 