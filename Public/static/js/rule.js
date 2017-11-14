function Rule(shudu){
	this.shudu=shudu;
	this.timer=null;
	this.running=false;
}
Rule.prototype.start=function(){
    this.running = true;
    this.timer = setInterval(this.run,1000);
}
Rule.prototype.run=function(){
	clearInterval(Rule.prototype.run);
	if(this.running==false){
		return;
	}
	var results=this.shudu.results;
	for(var i=0;i<results.length;i++){
		var posX=results[i].pos[0];
		var posY=results[i].pos[1];
        var conflicts = shudu.conflicts; //getConflicts
		//console.log('X='+posX+' Y'+posY+' |'+results[i].num);
		if(this.shudu.realMap[posX][posY] != results[i].num){
			return;
		}
	}
    //保存游戏记录
    var game_time = $('#s_time').val();
    var client_ip = $('#client_ip').val();
    var user_agent = $('#user_agent').val();
    $.ajax({
        url : U('Index/ajax_game'),
        type:'post',
        dataType:'json',
        data:{'game_time':game_time,'client_ip':client_ip,'user_agent':user_agent},
        async:true,
        success:function(data){
            if(!data.status){
                alert(data.msg);
            }
        }
    });
    alert("恭喜您，顺利过关");
	this.running = false;
    shudu.second('stop');
    window.location.reload();

};