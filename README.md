#Configuration


If you'd like to gather more data then you can use custom  data provider by adding specific infos
dashboard:<br>
  infos:<br>
     - 'Evrinoma\DashBoardBundle\Info\ProcInfo'<br>
     - 'Evrinoma\DashBoardBundle\Info\SysInfo'<br>
if you'd like to use a special handler <br>
  provider: App\DashBoard\Provider\DashBoardProvider<br>

Ovveride base menu<br>
dashboard:<br>
  menu: App\Menu\DashBoardMenu
  
or register new instance in file service.yml<br>
App\Menu\DashBoardMenu:<br>
  tags:
    - { name: evrinoma.menu }
 