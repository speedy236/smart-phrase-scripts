$(document).ready(function(){
    // cookie info
    $.cookieBar({
        message: 'Při poskytování našich služeb nám pomáhají soubory cookie. Využíváním našich služeb s jejich používáním souhlasíte.',
        acceptText: 'Rozumím',
        append: true,
        fixed: true,
        bottom: true,
        policyButton: true,
        policyText: 'Další informace',
        policyURL: '/cs-cookies'
    }); 
    
    // Active menu settings
    var pathname = window.location.pathname;
    var navChildrens = $('.navbar-nav').children('li');
    
    switch (pathname) {
        case "/cestovni-konverzace":
            navChildrens.eq(0).children('a').eq(0).addClass('active');
            break;       
        case "/vlastnosti-konverzace":
            navChildrens.eq(1).children('a').eq(0).addClass('active');
            break;     
        case "/jak-vypada-konverzace":
        case "/jak-vypada-ipad-konverzace":
        case "/jak-vypada-konverzace-android":
        case "/jak-vypada-konverzace-windows8":
            navChildrens.eq(2).children('a').eq(0).addClass('active');
            break; 
//        case "/blog-hospodska-anglictina":
//        case "/novinky":
//        case "/recenze":
//       case "/tipy":
//        case "/vtipy":
//            navChildrens.eq(3).children('a').eq(0).addClass('active');
//            break;       
        case "/uplatneni-cestovni-konverzace-staty":
            navChildrens.eq(3).children('a').eq(0).addClass('active');
            break;
        case "/podpora-fraze":
        case "/podpora-fraze-iphone":
        case "/podpora-fraze-android":
        case "/podpora-fraze-windows8":
            navChildrens.eq(4).children('a').eq(0).addClass('active');
            break;        
        case "/kontakt-fraze":
            navChildrens.eq(5).children('a').eq(0).addClass('active');
            break;       
    }
});