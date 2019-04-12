var mq = window.matchMedia( "(min-width: 1000px)" );
        function resizeElements(){
            if(mq.matches){
    Chart.defaults.global.defaultFontSize = 15;
}
else if( (window.matchMedia( "(min-width: 800px)" )).matches){
    Chart.defaults.global.defaultFontSize = 12;
}
else if((window.matchMedia( "(min-width: 600px)" )).matches){
    Chart.defaults.global.defaultFontSize = 10;
}
            else {
                Chart.defaults.global.defaultFontSize = 7;
            }
        }