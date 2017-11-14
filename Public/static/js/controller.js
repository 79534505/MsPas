var N = 3;
var DRAW_BOUNDS = [80,0,560,480];

var shudu;
var currentPos;
var canvas;
var status = true;

function main(){
	shudu=new Shudu(N,30);
	canvas=document.getElementById("canvas");
	canvas.addEventListener("click",selectGrid,true);
	window.addEventListener("keydown",insertNum,true);
	draw();
	rule = new Rule(shudu);
	rule.start();
}

//选择单元格
function selectGrid(event){
    //对象里面是没有这个东西的
    //var posX=event.pageX-canvas.offsetTop;
    //var posY=event.papeY-canvas.offsetLeft;
    var posX=event.offsetX;
    var posY=event.offsetY;


	//判断选中的位置
	var tmpPos=toPos(posX,posY);
	if(tmpPos==null){
		return;
	}
    //判断是否可以编辑
	currentPos=shudu.visible(tmpPos[0],tmpPos[1]) ? currentPos : tmpPos;

	draw();

}

//填写数据
function insertNum(event){
    //数字键盘的keyCode码为96-105
	var numStart=96;
    //如果选择不可编辑区域就返回
	if(currentPos == null){
        return;
    }
    //获取键盘输入的数据
	if(event.keyCode >= numStart && event.keyCode <= numStart+9){
        //得到键盘输入的数字
		var num=event.keyCode - numStart;
		shudu.insert(num,currentPos);
        if(status == 'true'){
           shudu.second('start');
        }
        status = false;

	}
	draw();
}
//判断是否在绘图区域内
function inDrawRange(x,y){
	if(x < DRAW_BOUNDS[0] || y < DRAW_BOUNDS[1]){
        return false;
    }

	if(DRAW_BOUNDS[2]+DRAW_BOUNDS[0] <= x|| DRAW_BOUNDS[3]+DRAW_BOUNDS[1] <= y){
        return false;
    }
	return true;
}

//将坐标转换为位置
function toPos(x,y){
	if(!inDrawRange(x,y)){
        return currentPos;
    }

	var CEIL_W = DRAW_BOUNDS[2]/(N*N);
	var CEIL_H = DRAW_BOUNDS[3]/(N*N);

	var posX = Math.floor((x-DRAW_BOUNDS[0])/CEIL_W);
	var posY = Math.floor((y-DRAW_BOUNDS[1])/CEIL_H);

	return [posX,posY];
}
