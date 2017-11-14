function draw(){
	var context=canvas.getContext("2d");
	if(!context){
		alert("您的浏览器不支持canvas");
	}
	var size=N*N;
	var ceil_w=DRAW_BOUNDS[2]/size;
	var ceil_h=DRAW_BOUNDS[3]/size;
	var font_size=24;
	var font_offsetH=DRAW_BOUNDS[0]+(ceil_w-font_size)/2+4;
	var font_offsetV=DRAW_BOUNDS[1]+(ceil_h-font_size)/2+24;
	context.clearRect(
		DRAW_BOUNDS[0],
		DRAW_BOUNDS[1],
		DRAW_BOUNDS[2],
		DRAW_BOUNDS[3]
	);

	//开始画格子
	context.lineWidth=1;
	context.strokeStyle="black";
	for(var i=0;i<size;i++){
		for(var j=0;j<size;j++){
			context.strokeRect(
				i*ceil_w+DRAW_BOUNDS[0],
				j*ceil_h+DRAW_BOUNDS[1],
				ceil_w,
				ceil_h
			);
		}
	}

	for(var i=0;i<shudu.realMap.length;i++){
		for(var j=0;j<shudu.realMap[i].length;j++){
			context.fillStyle=shudu.visible(i,j)?"gray":"white";
			context.fillRect(
				i*ceil_w+DRAW_BOUNDS[0],
				j*ceil_h+DRAW_BOUNDS[1],
				ceil_w,
				ceil_h
			);

            context.fillStyle="black";
            context.font="32px sans-serif";
            if(shudu.realMap[i][j]!=0){
            	context.fillText(
            		 shudu.realMap[i][j],
            		 ceil_w*i+font_offsetH,
            		 ceil_h*j+font_offsetV
            	)
            }
		}
	}


	context.lineWidth=5;
	context.strokeStyle="black";
	for(var i=1;i<N;i++){
		context.beginPath();
		context.moveTo(
			i*N*ceil_w+DRAW_BOUNDS[0],
			DRAW_BOUNDS[1]
		);
		context.lineTo(
			i*N*ceil_w+DRAW_BOUNDS[0],
			DRAW_BOUNDS[1]+DRAW_BOUNDS[3]

		);
		context.stroke();
	}
	for(var i=1;i<N;i++){
		context.beginPath();
		context.moveTo(
			  DRAW_BOUNDS[0],
			  i*N*ceil_h+DRAW_BOUNDS[1]
		);
		context.lineTo(
			DRAW_BOUNDS[0]+DRAW_BOUNDS[2],
			i*N*ceil_h+DRAW_BOUNDS[1]
		);
		context.stroke();
	}

	context.lineWidth=5;
	context.strokeStyle="blue";
	if(currentPos != null){
		context.strokeRect(
			currentPos[0]*ceil_w+DRAW_BOUNDS[0],
			currentPos[1]*ceil_h+DRAW_BOUNDS[1],
			ceil_w,
			ceil_h
		);
	}


	context.font="32px sans-serif";
    context.fillStyle="red";
	//获取错误
	var conflicts = shudu.conflicts; //getConflicts
    for(var i=0; i < conflicts.length; i++){
        var pos=conflicts[i].getPos();
        context.fillText(
            shudu.realMap[pos[0]][pos[1]],
            pos[0]*ceil_w+font_offsetH,
            pos[1]*ceil_h+font_offsetV
        );


        var positions = conflicts[0].getPositions;
        for(var j=0;j<positions.length;j++){
            context.fillText(
                shudu.realMap[pos[0]][pos[1]],
                positions[j][0]*ceil_w+font_offsetH,
                positions[j][1]*ceil_h+font_offsetV
            );
        }
    }


}