安装说明
1.将代码上传到服务器
2.配置数据库
  修改application/config/database.php
$db['default']['hostname'] = '127.0.0.1';//这个为数据库地址
$db['default']['username'] = 'root';//这个为数据库用户名
$db['default']['password'] = 'root';//这个为数据库密码
$db['default']['database'] = 'demoapk';//这个为数据库的数据库名称
$db['default']['dbprefix'] = '';//这个为表前缀，如果有前缀则填写，如表名称为test_user，则前缀为test_
修改以上几个地方内容为实际内容


数据库sql文件为根目录下demoapk.sql,直接在数据库导入此文件就可以完成数据库的创建，表的创建
php需要开启curl，mysql扩展

