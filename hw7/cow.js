"use strict";
window.onload = function() {
	$("listPage").hide();
	$("loginB").onclick = login;
	$("addB").onclick = add;
	$("removeB").onclick = remove;
	$("logout").onclick = logout;
};
function login() {
	var user_name = $F("u");
	var pass_word = $F("p");
	new Ajax.Request ("cowLogin.php",{
		method:"post",
		parameters: {username: user_name , password: pass_word},
		onSuccess: function(ajax) {
			//alert((ajax.responseText));
			var valid = JSON.parse(ajax.responseText);
			if(valid.success) {
				$("showcontent").hide();
				$("listPage").show();
				$("username").innerHTML = user_name;
				$("ff").innerHTML = "";
				new Ajax.Request("cowGet.php",{
					method:"post",
					onSuccess:function(ajax) {
						var valid = JSON.parse(ajax.responseText);
						var items = valid.items;
						var list = $("list");
						while(list.firstChild){
							list.removeChild(list.firstChild);
						}
						for(var i=0;i<items.length;i++){
							addItem(items[i]);		 
						} 
						createSortable();
					}
				});
			}
			else {
					$("ff").innerHTML = "login failed!";
				 }
		}
	});
}
function addItem(newItem) {
	var e = document.createElement("li");
	e.innerHTML = newItem;
	e.id = $("list").childNodes.length;
	e.hide();
	$("list").appendChild(e);
	e.appear();
}
function createSortable(){
	Sortable.create("list", {
            onUpdate: listUpdate
    });
}
function listUpdate(list) {   
    var tasks = {};
    tasks["items"] = [];
    $A($$('#list li')).each (function(e) {
      tasks["items"].push(e.innerHTML);
    });
      new Ajax.Request("cowUpdate.php", {
        method: "post",
        parameters: {taskList: JSON.stringify(tasks)}
      });
    }
function add(){
	var item = $$("#listForm input[name='newItem']")[0];
	var newItem = item.value; 
	if( newItem != ""){
		newItem = newItem.escapeHTML() ; 
		addItem(newItem);
		listUpdate( $("list") );
		createSortable();
		item.value = "";
	}
}
function remove(){
	var del = $("list").childNodes[0];
	del.fade({ 
	duration: 0.5 ,
	afterFinish:function(){ 
		$("list").removeChild(del);
		listUpdate( $("list") );
		createSortable();
	}
	});
}
function logout(){
    Sortable.destroy($('list'));
	new Ajax.Request("cowLogout.php",
	{
		method: "post",
		onSuccess: tologin
	}
	);
}

function tologin(ajax){ 
      window.location = 'cow.html';
}

function show(str){

	console.log(str);
}
