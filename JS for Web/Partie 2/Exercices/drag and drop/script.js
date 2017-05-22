(function() {

    var draggableBoxes = document.querySelectorAll('.draggableBox');

    var anonymousFunction;

    draggableBoxes.forEach(function(draggableBox){
        draggableBox.addEventListener('mousedown', function(){
            draggableBox.leftBorderCursorGap = event.clientX - draggableBox.offsetLeft;
            draggableBox.topBorderCursorGap = event.clientY - draggableBox.offsetTop;
            document.addEventListener('mousemove', anonymousFunction = function(event){
                draggableBox.style.left = event.clientX - (draggableBox.leftBorderCursorGap) + 'px';
                draggableBox.style.top = event.clientY - (draggableBox.topBorderCursorGap) + 'px';
            });
        });
        draggableBox.addEventListener('mouseup', function(event){
            document.removeEventListener('mousemove', anonymousFunction);
        });
    });

})();
