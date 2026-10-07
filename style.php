<style>
	/* SCROLLBAR STYLING */
	/* width */
	::-webkit-scrollbar {
		width: 6px;
		height: 3px;
	}
	/* Track */
	::-webkit-scrollbar-track {
		background: black; 
	}
	/* Handle */
	::-webkit-scrollbar-thumb {
		background: <?php echo $maincolor ?>; 
		border-radius: 6px;
	}
	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
		background: <?php echo $secondcolor ?>; 
	}

	h1, h2, h3, h4, h5, p{
		margin: 0px;
		margin-bottom: 10px;
	}

	p{
		margin-bottom: 15px;
	}
	
	div{
		outline: none;
	}

	body{
		padding: 0px;
		margin: 0px;
		font-family: 'Dosis', sans-serif;
		background-color: #4a4a4a;
		overflow-x: hidden;
		
		background: url(images/bgimage.jpg) no-repeat fixed center; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	
	
	input, select, textarea{
		box-sizing: border-box;
		width: 100%;
		padding: 20px;
		border-radius: 5px;
		margin-bottom: 20px;
		border: 2px solid <?php echo $maincolor ?>;
	}
	
	
	input[type=submit]{
		font-weight: bold;
		color: white;
	}
	
	input[type=checkbox]{
		width: 20px;
	}
	
	select{
		padding: 20px;
		border-radius: 0px;
		margin-bottom: 20px;
		border: none;
		outline: 2px solid <?php echo $maincolor ?>;
	}
	
	.submitbutton{
		background-color: <?php echo $maincolor ?>; 
		color: black;
		cursor: pointer;
	}
	.submitbutton:hover{
		background-color: <?php echo $secondcolor ?>; 
	}
	
	.fileinput{
		cursor: pointer;
		border: 3px dashed <?php echo $secondcolor ?>; 
	}
	
	.fileinput:hover{
		border: 3px solid <?php echo $secondcolor ?>; 
	}
	
	.textlink{
		text-decoration: underline;
		color: <?php echo $maincolor ?>; 
	}
	.textlink:hover{
		text-decoration: none;
	}
	
	a{
		color: inherit;
		text-decoration: none;
	}
	
	label{
		display: block;
		margin-bottom: 10px;
		font-size: 19px;
		margin-top: 30px;
	}
	
	#cartui{
		z-index: 130;
		background-color: rgba(0,0,0,.8);
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		display: none;
		position: fixed;
		padding: 50px;
		color: white;
		overflow: auto;
		backdrop-filter: blur(15px);
		-webkit-backdrop-filter: blur(15px);
	}
	
	.alert{
		background-color: green; 
		color: white;
		font-weight: bold;
		padding: 10px;
		border-radius: 5px;
		margin-bottom: 10px;
	}
	
	.categoryblock{
		display: inline-block;
		background-color: <?php echo $maincolor ?>; 
		border-radius: 10px;
		color: white;
		padding: 5px;
		font-weight: bold;
		margin: 5px;
	}
	
	.categoryblock:hover{
		background-color: white;
		color: <?php echo $maincolor ?>; 
	}
	
	table {
		border-collapse: collapse;
		width: 100%;
	}

	table, th, td {
		border: 1px solid black;
		font-size: 14px;
	}

	th{
		text-align: center;
		font-weight: bold;
		background-color: <?php echo $maincolor ?>;
		color: white;
	}

	th, td{
		padding: 10px;
	}

	tr:hover{
		background-color: white;
		color: <?php echo $maincolor ?>;
	}
	
	.inlinecenterblock{
		display: inline-block;
		vertical-align: middle;
		padding: 20px;
		padding: 10px; padding-top: 15px; padding-left: 20px; padding-right: 0px;
	}
	
	#header{
		background-color: rgba(255, 255, 255, .75);		
		font-size: 25px;
		/*border-bottom: 1px solid <?php echo $maincolor ?>;*/
		-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35);
		-moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35);
		box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35);
		
		backdrop-filter: blur(15px);
		-webkit-backdrop-filter: blur(15px);
		position: -webkit-sticky; /* Safari */
		position: sticky;
		top: 0;
		z-index: 100;
		
	}
	
	#categoriesbar{
		background-color: rgba(255, 255, 255, .5);		
		border-bottom: 1px solid white;
	}
	
	#cartbutton{
		position: fixed;
		right: 0;
		bottom: 0;
		padding: 30px;
		font-size: 60px;
		color: <?php echo $maincolor ?>;
		z-index: 100;
	}
	
	
	#imagedisplayer{
		background-color: rgba(0,0,0,.8);
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		padding: 50px;
		display: none;
		z-index: 120;
		text-align: center;
		overflow: auto;
		backdrop-filter: blur(15px);
		-webkit-backdrop-filter: blur(15px);
	}
	
	.searchbutton{
		cursor: pointer;
	}
	
	.searchbutton:hover{
		color: <?php echo $maincolor ?>;
		
		
	}
	
	.moreoncat:hover{
		color: black;
		transition: border .5s;
	}
	
	.catseparator{
		border-bottom: 1px solid white; padding-bottom: 14px;
		transition: border .5s;
	}
	
	.catseparator:hover{
		border-bottom: 1px solid <?php echo $maincolor ?>;
	}
	
	.section{
		padding: 20px;
	}
	
	.footerlink{
		background-color: #e0e0e0;
		display: table; 
		width: 100%;
		font-size: 13px;
		padding-left: 100px;
		padding-right: 100px;
		box-sizing: border-box;
	}
	
	.flblock{
		display: table-cell;
		text-align: left;
		padding: 20px;
		vertical-align: top;
		max-width: 200px;
	}
	
	.footercopyright{
		font-size: 11px;
		color: white;
		background-color: <?php echo $maincolor ?>;
		text-align: center;
	}
	
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}
	
	li{
		width: 100%;
		display: inline-block;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		transition: color .5s;
	}
	
	li:hover{
		color: <?php echo $maincolor ?>;
		transition: color .5s;
	}
	
	.firstthreeblock{
		margin: 30px;
		background-color: white;
		border-radius: 6px;
		border: 1px solid white;
		color: white;
		outline: none;
	}
	
	.morebutton{
		cursor: pointer;
		padding: 20px;
		border: 1px solid white;
		transition: background-color .5s;
		color: <?php echo $maincolor ?>;
		background-color: white;
		font-weight: bold;
	}
	
	.morebutton:hover{
		background-color: <?php echo $maincolor ?>;
		color: white;
		transition: background-color .5s;
	}
	
	.gridcontainer{
		overflow: auto;
		white-space: nowrap;
	}
	
	.gridcontainerunscrollable{
		display: flex;
		flex-wrap: wrap;
		flex-direction: row;
		justify-content: center;
		
	}
	
	/* SCROLLBAR STYLING */
	/* width */
	.gridcontainer::-webkit-scrollbar {
		width: 10px;
		height: 10px;
	}
	/* Track */
	.gridcontainer::-webkit-scrollbar-track {
		background: black; 
	}
	/* Handle */
	.gridcontainer::-webkit-scrollbar-thumb {
		border-radius: 6px;
		background: <?php echo $maincolor ?>; 
	}
	/* Handle on hover */
	.gridcontainer::-webkit-scrollbar-thumb:hover {
		background: <?php echo $secondcolor ?>; 
	}

	
	.filmblock{
		display: inline-block;
		margin: 10px;
		text-align: center;
		border: 2px solid white;
		transition: box-shadow .5s;
		width: 300px;
	}
	
	.filmblock:hover{
		-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35);
		-moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35);
		box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35);
		transition: box-shadow .5s;
	}
	
	.productthumbnail{
		width: 300px;
		height: 300px;
	}
	
	
	.filmblocktitleholder{
		position: absolute; bottom: 0; left: 0; right: 0; text-align: center; background-color: rgba(255,255,255,.75); padding: 10px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; color: black; backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px);
	}
	
	
	.hiddeninmobile{
		display: table-cell;
	}
	
	.firstthreecontainer{
		padding-left: 60px; padding-right: 60px;
	}
	
	.posttableblock{
		display: table; width: 100%;
	}
	
	.postcontent{
		display: table-cell;
		padding-right: 14px;
	}
	
	.randomvids{
		display: table-cell;
		width: 350px;
		vertical-align: top;
	}
	
	#productpic{
		width: 100%;
		height: 512px;
		background-color: black;
		outline: none;
		border-radius: 6px;
		
		
	}
	
	.randomvidblock{
		display: table;
		width: 350px;
		padding: 14px;
		box-sizing: border-box;
		transition: background-color .5s;
		border-radius: 5px;
		
	}
	
	.randomvidblock:hover{
		background-color: white;
		transition: background-color .5s;
		
	}
	
	.lilimage{
		display: table-cell;
		width: 128px;
		border-radius: 6px;
	}
	
	.lildescr{
		display: table-cell;
	}
	
	.shorttext{
		display: block;
		width: 200px;
		padding-left: 14px;
		box-sizing: border-box;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
	}
	
	#searchui{
		display: none;
		position: fixed; 
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0,0,0,.5);
		backdrop-filter: blur(15px);
		-webkit-backdrop-filter: blur(15px);
	}
	
	.sinputcontainer{
		position: absolute;
		top: 50%;
		left: 50%;
		margin-top: -50px;
		margin-left: -150px;
		width: 300px;
		height: 100px;
		text-align: center;
	}
	
	#searchinput{
		border-radius: 6px;
		outline: none;
		border: 3px solid <?php echo $maincolor ?>;
	}
	
	.smallinmobile{
		display: table-cell;
	}
	
	.w75{
		width: 75%;
	}
	
	.w25{
		width: 25%;
	}
	
	.brightonhover{
		display: table; width: 100%; height: 100%; background-color: rgba(0,0,0,.25); padding: 40px; box-sizing: border-box; border-radius: 6px;
		transition: background-color .5s;
	}
	
	.brightonhover:hover{
		background-color: rgba(0,0,0,.5);
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		transition: background-color .5s;
	}
	
	.slick-prev:before {
		color: <?php echo $maincolor ?>;
	}
	.slick-next:before {
		color: <?php echo $maincolor ?>;
	}
	
	.orderblock{
		background-color: white;
		border-radius: 6px;
		border: 2px solid <?php echo $maincolor ?>;
	}
	
	.buybutton{
		background-color: <?php echo $maincolor ?>;
		transition: background-color .5s;
		cursor: pointer;
		font-weight: bold;
		padding: 10px;
		display: inline-block;
		border-radius: 6px;
		color: white;
		margin-right: 10px;
	}
	
	.buybutton:hover{
		background-color: <?php echo $secondcolor ?>;
		transition: background-color .5s;
	}
	
	.shoppingcart{
		color: white;
		background-color: <?php echo $maincolor ?>;
		padding-bottom: 50px;
		margin-top: 20px;
	}
	
	.smallerinput input, label{
		margin-bottom: 2px;
		margin-top: 2px;
		padding: 5px;
		font-size: 14px;
	}
	
	.ordereditem{
		padding: 5px;
		margin-bottom: 2px;
		border-radius: 6px;
	}
	
	.ordereditem:hover{
		background-color: <?php echo $secondcolor ?>;
	}
	
	.floatright{
		float: right;
		margin-top: 10px;
		margin-right: 10px;
		width: 200px;
	}
	
	.producthalfbox{
		display: table-cell;
		vertical-align: top;
	}
	
	.leftphb{
		width: 256px;
		padding-right: 10px;
	}
	
	#imagepickerui{
		position: fixed;
		top: 0;
		left: 0; 
		right: 0;
		bottom: 0;
		background-color: rgba(0,0,0,.75);
		padding: 50px;
		color: white;
		
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
	}
	
	.cartbuttoncircle{
		width: 96px; height: 96px;
	}
	
	.loginform{
		padding: 100px; width: 400px; margin: 0 auto;
	}
	
	.adminmenubar{
		display: table-cell; width: 140px; background-color: black; color: white;
	}
	
	.barsbutton{
		display: none;
	}
	
	.stickythingy{
		position: -webkit-sticky; /* Safari */
		position: sticky;
		top: 0;
	}
	
	
	
	/* mobile view */
	@media (max-width: 800px){
		
		.inlinecenterblock{
			display: block;
			text-align: center;
			padding: 10px;
			box-sizing: border-box;
			width: 100%;
			margin: 0px;
		}
		
		
		#cartui{
			padding: 10px;
		}
		
		.buybutton{
			margin: 5px;
		}
		
		.barsbutton{
			display: block;
			position: fixed;
			top: 0;
			left: 0;
			padding: 7px;
			background-color: rgba(0,0,0,.75);
			color: white;
			z-index: 100;
		}
		
		.adminmenubar{
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			bottom: 0;
			z-index: 99;
			width: 40%;
			overflow: auto;
		}
		
		.stickythingy{
			position: static;
		}
		
		.loginform{
			padding: 10px;
			width: 100%;
			box-sizing: border-box;
		}
		
		
		.cartbuttoncircle{
			width: 64px; height: 64px;
		}
		
		#cartbutton{
			padding: 10px;
			font-size: 20px;
		}
		
		#header{
			position: static;
		}
		
		.productthumbnail{
			width: 128px;
			height: 128px;
		}
		
		.filmblock{
			width: 128px;
			font-size: 12px;
			margin: 2px;
		}
		
		.floatright{
			float: none;
			margin: 0px;
			width: 100%;
			box-sizing: border-box;
		}
		
		.footerlink{
			display: block;
			padding: 20px;
			width: 100%;
		}
		
		.smallinmobile{
			font-size: 10px;
			display: block;
			width: 100%;
			text-align: center;
		}
		
		.morebutton{
			width: 100px;
			padding: 10px;
			background-color: white;
			border: 1px solid white;
			color: <?php echo $maincolor ?>;
			margin: 0 auto;
		}
		
		.flblock{
			display: block;
			box-sizing: border-box;
			width: 100%;
			max-width: 720px;
		}
		
		.hiddeninmobile{
			display: none;
		}
		
		.firstthreecontainer{
			padding-left: 0px; padding-right: 0px;
			margin-bottom: -40px;
			margin-top: -20px;
		}
		
		.firstthreeblock{
			margin: 10px;
		}
		
		.posttableblock{
			display: block;
		}
		
		.postcontent{
			display: block;
			padding-right: 0px;
		}
		
		.randomvids{
			display: table;
			width: 100%;
			margin-top: 50px;
		}
		
		.randomvidblock{
			display: table;
			width: 100%;
			padding: 14px;
			transition: background-color .5s;
		}
		
		.randomvidblock:hover{
			background-color: white;
			transition: background-color .5s;
		}
		
		.lilimage{
			display: table-cell;
			height: 92px;
			width: 128px;
		}
		
		.lildescr{
			display: table-cell;
		}
		
		#webvideo{
			height: 256px;
		}
		
		.producthalfbox{
			display: block;
		}
		
		.leftphb{
			width: 100%;
		}
		
	}
	
	/* ============================================================
		  UI/UX ENHANCEMENTS
		  ============================================================ */
	
	/* Smooth scrolling & better focus visibility */
	html{
		scroll-behavior: smooth;
	}
	
	*:focus-visible{
		outline: 2px solid <?php echo $maincolor ?>;
		outline-offset: 2px;
	}
	
	/* Buttons: consistent transitions and active feedback */
	.buybutton, .morebutton, .submitbutton, .categoryblock{
		transition: background-color .25s ease, color .25s ease, transform .15s ease, box-shadow .25s ease;
	}
	
	.buybutton:active, .morebutton:active, .submitbutton:active, .categoryblock:active{
		transform: scale(.97);
	}
	
	.buybutton:hover, .morebutton:hover{
		box-shadow: 0px 6px 18px -6px rgba(0,0,0,.45);
	}
	
	/* Product cards: lift on hover */
	.filmblock{
		background-color: white;
		border-radius: 10px;
		overflow: hidden;
		transition: transform .25s ease, box-shadow .25s ease;
	}
	
	.filmblock:hover{
		transform: translateY(-4px);
		box-shadow: 0px 12px 28px -10px rgba(0,0,0,.5);
	}
	
	.productthumbnail{
		border-radius: 10px 10px 0 0;
		transition: transform .4s ease;
	}
	
	.filmblock:hover .productthumbnail{
		transform: scale(1.04);
	}
	
	/* Header: subtle entrance */
	#header{
		animation: headerDrop .4s ease;
	}
	
	@keyframes headerDrop{
		from{ transform: translateY(-100%); opacity: 0; }
		to{ transform: translateY(0); opacity: 1; }
	}
	
	/* Cart button: pulse when count changes */
	@keyframes cartPulse{
		0%{ transform: scale(1); }
		50%{ transform: scale(1.15); }
		100%{ transform: scale(1); }
	}
	
	.cart-pulse{
		animation: cartPulse .4s ease;
	}
	
	/* Toast notifications */
	#toast-container{
		position: fixed;
		bottom: 24px;
		left: 50%;
		transform: translateX(-50%);
		z-index: 200;
		display: flex;
		flex-direction: column;
		gap: 10px;
		align-items: center;
		pointer-events: none;
	}
	
	.toast{
		background-color: rgba(20,20,20,.95);
		color: white;
		padding: 14px 22px;
		border-radius: 50px;
		font-weight: bold;
		box-shadow: 0px 10px 30px -8px rgba(0,0,0,.6);
		display: flex;
		align-items: center;
		gap: 10px;
		animation: toastIn .3s ease;
		max-width: 90vw;
	}
	
	.toast.success{ background-color: #2e7d32; }
	.toast.error{ background-color: #c62828; }
	.toast.info{ background-color: <?php echo $maincolor ?>; }
	
	.toast.hide{
		animation: toastOut .3s ease forwards;
	}
	
	@keyframes toastIn{
		from{ transform: translateY(20px); opacity: 0; }
		to{ transform: translateY(0); opacity: 1; }
	}
	
	@keyframes toastOut{
		from{ transform: translateY(0); opacity: 1; }
		to{ transform: translateY(20px); opacity: 0; }
	}
	
	/* Empty state */
	.empty-state{
		text-align: center;
		padding: 50px 20px;
		color: #888;
	}
	
	.empty-state i{
		font-size: 56px;
		margin-bottom: 16px;
		display: block;
		opacity: .5;
	}
	
	.empty-state p{
		font-size: 18px;
		margin-bottom: 20px;
	}
	
	/* Cart UI improvements */
	#cartui .cart-line{
		display: flex;
		align-items: center;
		gap: 12px;
		padding: 12px;
		border-radius: 10px;
		background-color: rgba(255,255,255,.06);
		margin-bottom: 10px;
		transition: background-color .25s ease;
	}
	
	#cartui .cart-line:hover{
		background-color: rgba(255,255,255,.12);
	}
	
	#cartui .cart-line img{
		width: 64px;
		height: 64px;
		object-fit: cover;
		border-radius: 8px;
	}
	
	#cartui .cart-line .cart-line-info{
		flex: 1;
		font-size: 14px;
	}
	
	#cartui .cart-line .cart-line-total{
		font-weight: bold;
		white-space: nowrap;
	}
	
	#cartui .cart-line .cart-remove{
		cursor: pointer;
		color: #ff6b6b;
		padding: 8px;
		transition: transform .2s ease;
	}
	
	#cartui .cart-line .cart-remove:hover{
		transform: scale(1.2);
	}
	
	/* Cart summary card */
	.cart-summary{
		background-color: rgba(255,255,255,.08);
		border-radius: 12px;
		padding: 20px;
		margin-top: 20px;
	}
	
	/* Loading spinner */
	.spinner{
		display: inline-block;
		width: 18px;
		height: 18px;
		border: 3px solid rgba(255,255,255,.3);
		border-top-color: white;
		border-radius: 50%;
		animation: spin .8s linear infinite;
	}
	
	@keyframes spin{
		to{ transform: rotate(360deg); }
	}
	
	/* ============================================================
		  ADMIN PANEL STYLES
		  ============================================================ */
	
	.admin-page-header{
		margin-bottom: 24px;
	}
	
	.admin-page-header h1{
		font-size: 30px;
		margin-bottom: 4px;
	}
	
	.admin-page-subtitle{
		color: #777;
		font-size: 14px;
	}
	
	.admin-card{
		background-color: white;
		border-radius: 12px;
		box-shadow: 0px 4px 20px -8px rgba(0,0,0,.25);
		margin-bottom: 24px;
		overflow: hidden;
	}
	
	.admin-card-header{
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 16px 22px;
		border-bottom: 1px solid #eee;
		background-color: #fafafa;
	}
	
	.admin-card-header h2{
		font-size: 18px;
		margin: 0;
	}
	
	.admin-card-body{
		padding: 22px;
	}
	
	/* Stat cards */
	.stat-grid{
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
		gap: 18px;
		margin-bottom: 24px;
	}
	
	.stat-card{
		background-color: white;
		border-radius: 12px;
		padding: 20px;
		display: flex;
		align-items: center;
		gap: 16px;
		box-shadow: 0px 4px 20px -8px rgba(0,0,0,.25);
		transition: transform .25s ease, box-shadow .25s ease;
	}
	
	.stat-card:hover{
		transform: translateY(-3px);
		box-shadow: 0px 10px 28px -10px rgba(0,0,0,.35);
	}
	
	.stat-icon{
		width: 56px;
		height: 56px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		color: white;
		font-size: 24px;
		flex-shrink: 0;
	}
	
	.stat-value{
		font-size: 28px;
		font-weight: bold;
		line-height: 1;
	}
	
	.stat-label{
		color: #777;
		font-size: 13px;
		margin-top: 4px;
	}
	
	/* Quick actions */
	.quick-actions{
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 14px;
	}
	
	.quick-action{
		display: flex;
		flex-direction: column;
		align-items: center;
		gap: 10px;
		padding: 22px 12px;
		border-radius: 10px;
		background-color: #f5f5f5;
		color: #333;
		text-align: center;
		font-weight: bold;
		transition: background-color .25s ease, transform .2s ease, color .25s ease;
	}
	
	.quick-action i{
		font-size: 26px;
		color: <?php echo $maincolor ?>;
	}
	
	.quick-action:hover{
		background-color: <?php echo $maincolor ?>;
		color: white;
		transform: translateY(-3px);
	}
	
	.quick-action:hover i{
		color: white;
	}
	
	/* Recent list */
	.recent-list{
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	
	.recent-item{
		display: flex;
		align-items: center;
		gap: 14px;
		padding: 10px;
		border-radius: 10px;
		transition: background-color .25s ease;
	}
	
	.recent-item:hover{
		background-color: #f5f5f5;
	}
	
	.recent-thumb{
		width: 56px;
		height: 56px;
		border-radius: 8px;
		background-size: cover;
		background-position: center;
		flex-shrink: 0;
	}
	
	.recent-info{
		flex: 1;
		min-width: 0;
	}
	
	.recent-title{
		font-weight: bold;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	
	.recent-meta{
		font-size: 12px;
		color: #888;
		margin-top: 4px;
	}
	
	.recent-edit{
		color: <?php echo $maincolor ?>;
		font-size: 18px;
	}
	
	/* Forms */
	.form-group{
		margin-bottom: 18px;
	}
	
	.form-group label{
		margin-top: 0;
	}
	
	.form-row{
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
		gap: 16px;
	}
	
	.form-actions{
		margin-top: 10px;
	}
	
	.inline-form{
		display: flex;
		gap: 12px;
		align-items: flex-start;
	}
	
	.inline-form input[type=text]{
		margin-bottom: 0;
	}
	
	.inline-form .submitbutton{
		width: auto;
		padding: 20px 30px;
		white-space: nowrap;
	}
	
	.subform{
		background-color: #f7f7f7;
		border-radius: 10px;
		padding: 18px;
		margin-top: 14px;
	}
	
	.imgvisual, .optionsvisual{
		margin-bottom: 12px;
	}
	
	.current-image img{
		max-width: 200px;
		border-radius: 8px;
		margin-bottom: 12px;
		display: block;
	}
	
	/* Toggle switches */
	.toggle-group{
		display: flex;
		flex-direction: column;
		gap: 12px;
	}
	
	.toggle{
		display: flex;
		align-items: center;
		gap: 10px;
		margin: 0;
		font-size: 16px;
		cursor: pointer;
	}
	
	.toggle input[type=checkbox]{
		width: 20px;
		height: 20px;
		margin: 0;
		accent-color: <?php echo $maincolor ?>;
	}
	
	/* Category list */
	.category-list{
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	
	.category-row{
		display: flex;
		align-items: center;
		gap: 10px;
	}
	
	.category-edit-form{
		display: flex;
		gap: 10px;
		flex: 1;
	}
	
	.category-edit-form input[type=text]{
		margin-bottom: 0;
	}
	
	.icon-btn{
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 44px;
		height: 44px;
		border-radius: 8px;
		border: none;
		background-color: <?php echo $maincolor ?>;
		color: white;
		cursor: pointer;
		font-size: 16px;
		transition: background-color .25s ease, transform .15s ease;
		flex-shrink: 0;
	}
	
	.icon-btn:hover{
		background-color: <?php echo $secondcolor ?>;
	}
	
	.icon-btn:active{
		transform: scale(.94);
	}
	
	.icon-btn.danger{
		background-color: #e53935;
	}
	
	.icon-btn.danger:hover{
		background-color: #c62828;
	}
	
	/* Picture grid */
	.picture-grid{
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
		gap: 14px;
	}
	
	.picture-item{
		position: relative;
		border-radius: 10px;
		overflow: hidden;
		box-shadow: 0px 3px 12px -6px rgba(0,0,0,.4);
	}
	
	.picture-item img{
		width: 100%;
		height: 120px;
		object-fit: cover;
		display: block;
		cursor: pointer;
		transition: transform .3s ease;
	}
	
	.picture-item:hover img{
		transform: scale(1.06);
	}
	
	.picture-delete{
		position: absolute;
		top: 6px;
		right: 6px;
		width: 32px;
		height: 32px;
		border-radius: 50%;
		background-color: rgba(229,57,53,.9);
		color: white;
		display: flex;
		align-items: center;
		justify-content: center;
		opacity: 0;
		transition: opacity .25s ease;
	}
	
	.picture-item:hover .picture-delete{
		opacity: 1;
	}
	
	/* Order list */
	.order-list{
		display: flex;
		flex-direction: column;
		gap: 14px;
	}
	
	.order-item{
		border: 1px solid #eee;
		border-radius: 10px;
		overflow: hidden;
	}
	
	.order-head{
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 10px 14px;
		background-color: #fafafa;
		border-bottom: 1px solid #eee;
	}
	
	.order-date{
		font-size: 13px;
		color: #666;
		font-weight: bold;
	}
	
	.order-message{
		margin: 0;
		padding: 14px;
		font-family: 'Dosis', monospace;
		font-size: 13px;
		white-space: pre-wrap;
		word-break: break-word;
		background-color: white;
	}
	
	/* Progress bar */
	.progress{
		margin-bottom: 20px;
	}
	
	.progress-label{
		font-size: 13px;
		margin-bottom: 6px;
		font-weight: bold;
	}
	
	.progress-track{
		height: 8px;
		background-color: #eee;
		border-radius: 10px;
		overflow: hidden;
	}
	
	.progress-track .bar{
		height: 100%;
		background-color: <?php echo $maincolor ?>;
		width: 0;
		transition: width .3s ease;
	}
	
	/* Admin login */
	.loginform{
		background-color: white;
		border-radius: 16px;
		box-shadow: 0px 20px 60px -20px rgba(0,0,0,.5);
		margin-top: 60px;
	}
	
	/* Admin sidebar active state */
	.adminleftbaritem.active{
		background-color: <?php echo $maincolor ?>;
		color: white;
	}
	
	/* Admin mobile backdrop */
	#adminbackdrop{
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0,0,0,.5);
		z-index: 98;
		animation: fadeIn .2s ease;
	}
	
	@keyframes fadeIn{
		from{ opacity: 0; }
		to{ opacity: 1; }
	}
	
	/* Admin mobile bars button */
	.barsbutton{
		border-radius: 0 0 8px 0;
		transition: background-color .25s ease;
	}
	
	.barsbutton:hover{
		background-color: <?php echo $maincolor ?>;
	}
	
	/* Mobile admin adjustments */
	@media (max-width: 800px){
		.admin-card-body{
			padding: 16px;
		}
		
		.admin-page-header h1{
			font-size: 24px;
		}
		
		.inline-form{
			flex-direction: column;
		}
		
		.inline-form .submitbutton{
			width: 100%;
		}
		
		.category-edit-form{
			flex-direction: column;
		}
		
		.category-row{
			flex-direction: column;
			align-items: stretch;
		}
		
		.stat-grid{
			grid-template-columns: 1fr;
		}
	}
	
</style>