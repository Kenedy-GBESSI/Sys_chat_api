import './bootstrap';
Window.Echo.channel('chat').listen('.my-event',function(e){
   console.log(e)
})
