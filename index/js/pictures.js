(function ($) {
    //$(document).ready(function (){
    var aPage = $('#main .page a');		//分页按钮
    var aImg = $('#main .box img');		//图像集合
    var iSize = aImg.size();		//图像个数
    var index = 0;		//切换索引
    //var t;
    $('#btnLeft').click(function () {		//左边按钮点击
        index--;
        if (index < 0) {
            index = iSize - 1
        }
        change(index)
    })
    $('#btnRight').click(function () {    //右边按钮点击
        index++;
        if (index > iSize - 1) {
            index = 0
        }
        change(index)
    })
    //分页按钮点击
    aPage.click(function () {
        index = $(this).index();
        change(index)
    });

    //切换过程
    function change(index) {
        aPage.removeClass('active');
        aPage.eq(index).addClass('active');
        aImg.stop();
        //隐藏除了当前元素，所以图像
        aImg.eq(index).siblings().animate({
            opacity: 0
        }, 1000)
        //显示当前图像
        aImg.eq(index).animate({
            opacity: 1
        }, 1000)
    }

    function autoshow() {
        index = index + 1;
        if (index <= iSize - 1) {
            change(index);
        } else {
            index = 0;
            change(index);
        }

    }

    intt = setInterval(autoshow, 3000);

    function clearInt() {
        $('#btnLeft,#btnRight,.page a').mouseover(function () {
            clearInterval(intt);
        })

    }

    function setInt() {
        $('#btnLeft,#btnRight,.page a').mouseout(function () {
            intt = setInterval(autoshow, 3000);
        })
    }

    //int=setInterval(autoshow,3000);
    clearInt();
    setInt();
    //});
})(jQuery);