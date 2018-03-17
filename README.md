<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
"# myshop" 
1.项目描述简介：类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)
现在的社会是电商飞速发展的一个过程，现在的电商越来越多，越来越多的人都在网上购物，电商已经进入一个飞速发展的时期。
为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。
为了让大家掌握公司协同开发要点，我们使用git管理代码。
在项目中会使用很多前面的知识，比如架构、维护等等。
2. 主要功能模块
系统包括：
后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
前台：首页、商品展示、商品购买、订单管理、在线支付等。
3.1.1. 开发环境和技术
开发环境 Window
开发工具 Phpstorm+PHP5.6+GIT+Apache
相关技术 Yii2.0+CDN+jQuery+sphinx
4.1.4.项目人员组成周期成本
  1.4.1.人员组成
  职位	人数	备注
  项目经理和组长	1	一般小公司由项目经理负责管理，中大型公司项目由项目经理或组长负责管理
  开发人员	2-3	
  UI设计人员	0	
  前端开发人员	1	专业前端不是必须的，所以前端开发和UI设计人员可以同一个人
  测试人员	1	有些公司并未有专门的测试人员，测试人员可能由开发人员完成测试。
  
  公司有测试部，测试部负责所有项目的测试。
  
  项目测试由产品经理进行业务测试。
  
  项目中如果有测试，一般都具有Bug管理工具。（介绍某一个款，每个公司Bug管理工具不一样）
  1.4.2.项目周期成本
  人数	周期	备注
  1	两周需求及设计	项目经理 
  
  
  1	两周
  UI设计	UI/UE
  4（1测试  2后端  1前端）	3个月
  第1周需求设计
  9周时间完成编码
  2周时间进行测试和修复	
  
  开发人员、测试人员
  2.系统功能模块
  2.1.需求
  品牌管理：
  商品分类管理：
  商品管理：
  账号管理：
  权限管理：
  菜单管理：
  订单管理：
  
  2.2.流程
  自动登录流程
  购物车流程
  订单流程
  2.3.设计要点（数据库和页面交互）
  系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化
  商品无限级分类设计：
  购物车设计
 
难点：难点在于需要掌握实际工作中，如何分析思考业务功能，如何在已有知识积累的前提下搜索并解决实际问题，抓大放小，融会贯通，尤其要排除畏难情绪遇到不懂得问题要及时的解决，遇到困难不要放弃，遇到问题要多思考。
品牌管理功能：品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。
       品牌需要保存缩略图和简介。
       品牌删除使用逻辑删除。 
 3.4.要点难点及解决方案
 1.删除使用逻辑删除,只改变status属性,不删除记录
 2.使用webuploader插件,提升用户体验
 3.使用composer下载和安装webuploader
 4.composer安装插件报错,解决办法:
 composer global require "fxp/composer-asset-plugin:^1.2.0"
 5.注册七牛云账号


