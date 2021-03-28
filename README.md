# Imgchv
## 插件说明
* Imgchv是为Mediawiki开发的一个插件。它只是实现功能，慎重用于正式环境。由于作者代码只懂皮毛，代码并不科学，欢迎优化。
* 在Chevereto的图床程序中，jpg格式可以将外链由原图.jpg改为中等图片.md.jpg，本插件利用此特性使得加载图片大小变小，提升加载体验。 
* 使用钩子[ParserFirstCallInit](https://www.mediawiki.org/wiki/Manual:Hooks/ParserFirstCallInit)创建一个标签`<imgchv />`，将图片在解析时是设定链接时改用.md链接，且提供一个按钮以点击显示原图链接。
* 文件写法参考：[HTMLTags插件](https://github.com/wikimedia/mediawiki-extensions-HTMLTags/blob/master/includes/HTMLTags.php)
* 目前尚不明确有无插件冲突或其他问题，按钮及显示原图样式可能需要完善以更好体验。
* 最新：发现有个别图片没有.md中等图片链接，本插件没有判断中等图片是否存在的办法，请使用前自行确认图片的中等图片存在。
## 使用方法
* 下载放在extensions/文件夹内；
* 在LocalSettings.php加入`wfLoadExtension( 'Imgchv' );`；
* 设置参数`$wgImgchvDomainName=["子域名"];`（需要填写完整子域名，如a.xxx.com，需要填写完整子域名，任何Chevereto程序的图床网站外链均可）；
* 完成。
* 在需要使用时写：`<imgchv width="" height="" src=""/>`。其中src为Chevereto的图床程序的原图链接。
## 更新日志
20210328:调整使用自带按钮样式；使用hover显示按钮，但有bug：插件的css貌似最后才加载，会先显示按钮，待完全加载完页面css才会隐藏按钮。
