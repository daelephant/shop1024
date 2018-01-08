$(".tron").mouseover(function () {
    //鼠标事件,修改每个tr里面td的背景颜色，注意tr是没有背景颜色的
    $(this).find("td").css('backgroundColor','#DEE7F5');
});
//id的选择用#，class用.点
$(".tron").mouseout(function () {
    //鼠标事件修改每个tr里面td的背景颜色，注意tr是没有背景颜色的
    $(this).find("td").css('backgroundColor','#FFF');
});