window.onload = function(){
    imgLocation("container","box");//将container下的所有box取出


}
// 函数返回一个布尔类型的值，true允许加载，false不允许
function checkFlag(){
    // 首先得到最后一张图片
    var cparent = document.getElementById("container");
    var ccontent = getChildElement(cparent,"box");
    var lastContentHeight = ccontent[ccontent.length - 1].offsetTop;//得到最后一个图片距顶部的高度
    // 这里考虑到浏览器的兼容性，||两种方法获取
    // console.log(lastContentHeight);
    var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;//得到滚动的变化
    var pageHeight = document.documentElement.clientHeight||document.body.clientHeight;//得到页面的高度
    // console.log(pageHeight);
    // 判断  若最后一张图片距顶部的高度 < 页面高度+滚动条的变化高度  ---->true
    if(lastContentHeight < scrollTop + pageHeight){
        return true;
    }
}


function imgLocation(parent,content){
    // 将parent下多有的content全部取出
    var cparent = document.getElementById(parent);
    //存入
    var ccontent = getChildElement(cparent,content);
    // console.log(ccontent);
    var imgWidth = ccontent[0].offsetWidth;
    // 得到屏幕宽度
    var number = Math.floor(document.documentElement.clientWidth / imgWidth);//得到整数，即为每行所承受的图片数
    //设置父级样式内容
    cparent.style.cssText = "width:"+imgWidth*number+"px; margin:0 auto;";//使其不会随浏览器的变化而浮动  居中


    //使第二行永远都往第一行最矮的位置插入
    var BoxHeightArr=[];//数组承载第一排的所有高度
    // 循环依次累加
    for(var i = 0; i < ccontent.length; i++){
        if(i < number){
            //第一排的高度
            BoxHeightArr[i] = ccontent[i].offsetHeight;
            
        }
        else{
            var minHeight = Math.min.apply(null,BoxHeightArr);//得到最小高度
            var minIndex = getminheightLocation(BoxHeightArr,minHeight);
            // 摆放
            ccontent[i].style.position = "absolute";//绝对布局
            ccontent[i].style.top = minHeight+"px";
            // 得到位置后只要设置图片居左的宽度为上图的宽度或倍数即可
            ccontent[i].style.left = ccontent[minIndex].offsetLeft+"px";
            BoxHeightArr[minIndex] += ccontent[i].offsetHeight;
        }
        

    }

}

// 得到最小高度竖排位置函数
function getminheightLocation(BoxHeightArr,minHeight){
    for(var i in BoxHeightArr){
        if(BoxHeightArr[i] == minHeight)
        return i;
    }

}

// 存储(数组)
function getChildElement(parent,content){
    var contentArr = [];
    var allcontent = parent.getElementsByTagName("*");//获取所有元素  *
    // 循环将其全部box放入数组当中
    for(var i = 0; i < allcontent.length; i++){
        //判断
        if(allcontent[i].className == content){
            contentArr.push(allcontent[i]);//在其末位追加
        }
    }
    return contentArr;
} 