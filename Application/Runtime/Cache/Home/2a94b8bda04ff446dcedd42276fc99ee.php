<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数独游戏</title>
	<link type="text/css" rel="stylesheet" href="/Public/static/css/base.css">
	<link type="text/css" rel="stylesheet" href="/Public/static/css/index.css">
	<script type="text/javascript">
		var SITE_URL  = '';
		//载入函数
		var U = function(url, params) {
			var website = SITE_URL+'/index.php'
			url = url.split('/');
			if(url[0] == '' || url[0] == '@')
				url[0] = '';
			if (!url[1])
				url[1] = 'Index';
			if (!url[2])
				url[2] = 'index';
			website = website+'/'+url[0]+'/'+url[1];
			if(params) {
				params = params.join('&');
				website = website + '&' + params;
			}
			return website;
		};
	</script>
<script type="text/javascript" src="/Public/static/js/model.js"></script>
<script type="text/javascript" src="/Public/static/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/Public/static/js/view.js"></script>
<script type="text/javascript" src="/Public/static/js/rule.js"></script>
<script type="text/javascript" src="/Public/static/js/controller.js"></script>
</head>
<body>
	<div class="content">
		<!--分数-->
		<div class="content_wrap">
			<div class="score_list">
				<p>排行榜</p>
				<!--用户列表-->
				<ul>
					<li>
						<div>用户名</div>
						<div>时间</div>
						<div>排名</div>
					</li>

					<?php if(is_array($rank_list)): $i = 0; $__LIST__ = $rank_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div><?php echo ($vo['username']); ?></div>
							<div><?php echo ($vo['game_time']); ?></div>
							<div><?php echo ($vo['rank']); ?></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>

			</div>

			<!--游戏界面-->
			<div class="game_frame">
				<canvas id="canvas" width="640" height="480"></canvas>
			</div>

			<!--用户信息-->
			<div class="userinfo">
				<p>个人信息</p>
				<ul>
					<li>
						<div>用 户 名 :</div>
						<div><?php echo ($member['username']); ?></div>
					</li>

					<li>
						<div>游戏次数:</div>
						<div><?php echo ($user_info['count']); ?></div>
					</li>

					<li>
						<div>当前排名:</div>
						<div><?php echo ($user_info['rank']); ?></div>
					</li>

					<li>
						<div>最好成绩:</div>
						<div><?php echo ($user_info['game_time']); ?></div>
					</li>

					<li>
						<div>当前时间:</div>
						<div  id="time">00:00:00</div>
					</li>
				</ul>
				<input type="hidden" id="s_time" value=""/>
				<input type="hidden" id="client_ip" value="<?php echo ($client_ip); ?>"/>
				<input type="hidden" id="user_agent" value="<?php echo ($user_agent); ?>"/>
			</div>

			<!--游戏记录-->
			<div class="game_record">
				<p>游戏记录</p>
				<ul>
					<li>
						<table>

							<tr>
								<td>用 户 名 </td>
								<td>游戏时间</td>
								<td>游戏用时</td>
							</tr>

							<?php if(is_array($game_list)): $i = 0; $__LIST__ = $game_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
									<td><?php echo ($vo['username']); ?></td>
									<td><?php echo ($vo['time']); ?></td>
									<td><?php echo ($vo['game_time']); ?></td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</table>
					</li>
				</ul>
			</div>

		</div>

	</div>


</body>
<script>
    main();
</script>
</html>