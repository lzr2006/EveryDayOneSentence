// NOTE:打印出object对象所有的属性 返回包含object所有属性 的数组
function Utils()
{
	this.UtilsPrintObject = function(obj)
	{
		var array = []
		for (var item in obj) {
			//  str +=item+":"+result[item]+"\n";
			//  console.log(item)
			console.log("！-遍历输出-！object属性->" + obj[item] + "\n");
			array.push(obj[item])
		}
		return array
	}
}
window.Utils = new Utils()
// NOTE: 自动解决http混合问题
function auto_set_http_mix() {
    $("head").append('<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">')
}