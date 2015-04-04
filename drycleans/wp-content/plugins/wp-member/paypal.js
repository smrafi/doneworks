function paypal_sort(field, sort_type) {
	new Ajax.Request(this_url, {
					onSuccess : paypal_reload_members,
					onFailure : function(resp) {
						alert("Oops, there's been an error. Please try again later.");
					},
					parameters : "field=" + field + "&type=" + sort_type + "&page=" + current_page + "&pagelen=" + per_page
				}
			);
}

function paypal_members_page(page) {
	if (page == 'next') {
		cpage = $('page_number').value;
		page = parseInt(cpage) + 1;
	}
	
	if (page == 'prev') {
		cpage = $('page_number').value;
		page = parseInt(cpage) - 1;
	}
	
	new Ajax.Request(this_url, {
					onSuccess : function(resp) {
						paypal_reload_members(resp);
						$('page_number').value = page;
						
						$('prev').disabled = (page <= 1) ? true : false;
						$('next').disabled = (page >= pages) ? true : false;
					},
					onFailure : function(resp) {
						alert("Oops, there's been an error. Please try again later.");
					},
					parameters : "field="+ sfld +"&type="+ stpe +"&page=" + page + "&pagelen=" + per_page
				}
			);
}

function paypal_reload_members(resp) {
	eval('var obj = '+resp.responseText);
	var frm = $('paypal_members_form');
	var ctr = $('ctr');
	
	// build the headers
	var tbl = document.createElement("table");
	var tbody = document.createElement("tbody");
	var tr_head = document.createElement("tr");
	var th_chk = document.createElement("th");
	var th_username = document.createElement("th");
	var th_email = document.createElement("th");
	var th_account = document.createElement("th");
	var th_dates = document.createElement("th");
	var th_fee = document.createElement("th");
	var th_status = document.createElement("th");
	var lh_username = document.createElement("a");
	
	tbl.width = "100%";
	tbl.border = "0";
	tbl.cellpadding = "5";
	tbl.cellspacing = "5";
	
	th_chk.scope = "col";
	th_username.scope = "col";
	th_email.scope = "col";
	th_account.scope = "col";
	th_dates.scope = "col";
	th_fee.scope = "col";
	th_status.scope = "col";
	
	type = 1;
	if (obj.sort_type == 'ASC') {
		new_type = 0;
	} else {
		new_type = 1;
	}
	
	if (obj.sort_field == 'chk') {
		th_chk.innerHTML = "<a href=\"javascript: paypal_sort('chk', "+ new_type +");\">&nbsp;</a>";
	} else {
		th_chk.innerHTML = "<a href=\"javascript: paypal_sort('chk', 1);\">&nbsp;</a>";
	}
	
	if (obj.sort_field == 'username' || obj.sort_field == 'id') {
		if (obj.sort_field == 'username') {
			th_username.innerHTML = "<a href=\"javascript: paypal_sort('username', "+ new_type +");\">Username</a> [<a href=\"javascript: paypal_sort('id', 1); \">ID</a>]";
		} else if (obj.sort_field == 'id') {
			th_username.innerHTML = "<a href=\"javascript: paypal_sort('username', 1);\">Username</a> [<a href=\"javascript: paypal_sort('id', "+ new_type +"); \">ID</a>]";
		}
	} else {
		th_username.innerHTML = "<a href=\"javascript: paypal_sort('username', 1);\">Username</a> [<a href=\"javascript: paypal_sort('id', 1); \">ID</a>]";
	}
	
	if (obj.sort_field == 'email') {
		th_email.innerHTML = "<a href=\"javascript: paypal_sort('email', "+ new_type +");\">Email</a>";
	} else {
		th_email.innerHTML = "<a href=\"javascript: paypal_sort('email', 1);\">Email</a>";
	}
	
	if (obj.sort_field == 'account_type') {
		th_account.innerHTML = "<a href=\"javascript: paypal_sort('account_type', "+ new_type +");\">Account Type</a>";
	} else {
		th_account.innerHTML = "<a href=\"javascript: paypal_sort('account_type', 1);\">Account Type</a>";
	}
	
	if (obj.sort_field == 'reg_date' || obj.sort_field == 'last_payment' || obj.sort_field == 'expire_date') {
		if (obj.sort_field = 'reg_date') {
			th_dates.innerHTML = "<a href=\"javascript: paypal_sort('reg_date', "+ new_type +");\">Registration Date</a> <br /><a href=\"javascript: paypal_sort('last_payment', 1);\">Last payment</a> <br /><a href=\"javascript: paypal_sort('expire_date', 1);\">Expire date</a>";
		} else if (obj.sort_field == 'last_payment') {
			th_dates.innerHTML = "<a href=\"javascript: paypal_sort('reg_date', 1);\">Registration Date</a> <br /><a href=\"javascript: paypal_sort('last_payment', "+ new_type +");\">Last payment</a> <br /><a href=\"javascript: paypal_sort('expire_date', 1);\">Expire date</a>";
		} else if (obj.sort_field == 'expire_date') {
			th_dates.innerHTML = "<a href=\"javascript: paypal_sort('reg_date', 1);\">Registration Date</a> <br /><a href=\"javascript: paypal_sort('last_payment', 1);\">Last payment</a> <br /><a href=\"javascript: paypal_sort('expire_date', "+ new_type +");\">Expire date</a>";
		}
	} else {
		th_dates.innerHTML = "<a href=\"javascript: paypal_sort('reg_date', 1);\">Registration Date</a> <br /><a href=\"javascript: paypal_sort('last_payment', 1);\">Last payment</a> <br /><a href=\"javascript: paypal_sort('expire_date', 1);\">Expire date</a>";
	}
	
	if (obj.sort_field == 'fee') {
		th_fee.innerHTML = "<a href=\"javascript: paypal_sort('fee', "+ new_type +");\">Fee</a>";
	} else {
		th_fee.innerHTML = "<a href=\"javascript: paypal_sort('fee', 1);\">Fee</a>";
	}
	
	if (obj.sort_field == 'status') {
		th_status.innerHTML = "<a href=\"javascript: paypal_sort('status', "+ new_type +");\">Status</a>";
	} else {
		th_status.innerHTML = "<a href=\"javascript: paypal_sort('status', 1);\">Status</a>";
	}
	
	Element.update(ctr,'');
	
	tr_head.appendChild(th_chk);
	tr_head.appendChild(th_username);
	tr_head.appendChild(th_email);
	tr_head.appendChild(th_account);
	tr_head.appendChild(th_dates);
	tr_head.appendChild(th_fee);
	tr_head.appendChild(th_status);
	
	tbody.appendChild(tr_head);
	
	// build the rows 
	if (obj.users.length > 0) {
		for (x = 0; x < obj.users.length; x++) {
			var tr = document.createElement("tr");
			var td_chk = document.createElement("td");
			var td_username = document.createElement("td");
			var td_email = document.createElement("td");
			var td_account = document.createElement("td");
			var td_date = document.createElement("td");
			var td_fee = document.createElement("td");
			var td_status = document.createElement("td");
			
			tr.className = obj.users[x].class_name;
			
			td_chk.innerHTML = '<input type="checkbox" name="ps[]" id="user_'+ obj.users[x].user_id +'" value="'+ obj.users[x].user_id +'" />';
			td_chk.align = 'center';
			
			td_username.innerHTML = '<label for="user_'+ obj.users[x].user_id +'"><strong>'+ obj.users[x].user_login +'</strong> ['+ obj.users[x].user_id +']</label>';
			td_username.align = 'center';
			
			td_email.innerHTML = '<a href="mailto:'+ obj.users[x].user_email +'">'+ obj.users[x].user_email +'</a>';
			td_email.align = 'center';
			
			td_account.innerHTML = obj.users[x].account_type;
			td_account.align = 'center';
			
			td_date.innerHTML = obj.users[x].dates;
			td_date.align = 'center';
			
			td_fee.innerHTML = obj.users[x].fee;
			td_fee.align = 'center';
			
			td_status.innerHTML = obj.users[x].status;
			td_status.align = 'center';
			
			tr.appendChild(td_chk);
			tr.appendChild(td_username);
			tr.appendChild(td_email);
			tr.appendChild(td_account);
			tr.appendChild(td_date);
			tr.appendChild(td_fee);
			tr.appendChild(td_status);
			tbody.appendChild(tr);
		}
	}
	
	tbl.appendChild(tbody);
	ctr.appendChild(tbl);
	//frm.appendChild(ctr);
}

function paypal_toggle_check(name, isChecked) {
	var el = document.getElementsByName(name);
	
	for (x = 0; x < el.length; x++) {
		el[x].checked = isChecked;
	}
}

function paypal_addAccountType() {
	tbl = $('type_table');
	
	var name = prompt('Enter the name of the new account type');
	
	
	var tr = document.createElement("TR");
	var td1 = document.createElement("TD");
	var td2 = document.createElement("TD");
	var sel = document.createElement("SELECT");
	
	tr.className = "alternate";
	tr.appendChild(td1);
	tr.appendChild(td2);
	
	td1.innerHTML = name;
	td2.innerHTML = 'Delete and move users of this type to...';
	
	tbl.appendChild(tr);
}

function paypal_addPackageForm() {
	tbl = $('paypal_packs');
	accounts = types;
	
	
	html = '<tr class="alternate" id="paypal_pack_'+x_pack+'"><td><input type="text" name="duration[]" value="3" /></td><td><select name="duration_type[]"><option value="d" selected="selected">Days</option><option value="m" >Months</option><option value="y" >Years</option></select></td><td><input type="text" name="cost[]" value="0" /></td><td><select name="account_type[]">';
	
	for (var x = 0; x < accounts.length; x++) {
		html += '<option value="'+accounts[x]+'">'+ accounts[x] +'</option>';
	}
	
	html += '</select></td><td><a href="javascript: paypal_removePackageForm('+x_pack+');">Delete</a></td></tr>';
	new Insertion.Bottom(tbl, html);
	
	/*

	// create the elements
	tr = document.createElement("TR");
	td_duration = document.createElement("TD");
	td_durtype = document.createElement("TD");
	td_cost = document.createElement("TD");
	td_account = document.createElement("TD");
	td_remove = document.createElement("TD");
	
	el_duration = document.createElement("INPUT");
	el_durtype = document.createElement("SELECT");
	opt_day = document.createElement("OPTION");
	opt_month = document.createElement("OPTION");
	opt_year = document.createElement("OPTION");
	el_cost = document.createElement("INPUT");
	el_account = document.createElement("SELECT");
	el_remove = document.createElement("A");
	
	// Form the elements
	tr.className = "alternate";
	tr.id = "paypal_pack_"+ x_pack;
	tr.style.display = "none";
	
	el_duration.type = "text";
	el_duration.name = "duration[]";
	
	el_durtype.name = "duration_type[]";
	opt_day.value = 'd';
	opt_day.innerHTML = 'Days';
	opt_month.value = 'm';
	opt_month.innerHTML = 'Months';
	opt_year.value = 'y';
	opt_year.innerHTML = 'Years';
	el_durtype.appendChild(opt_day);
	el_durtype.appendChild(opt_month);
	el_durtype.appendChild(opt_year);
	
	el_cost.type = "text";
	el_cost.name = "cost[]";
	
	el_account.name = "account_type[]";
	for (var x = 0; x < accounts.length; x++) {
		el_acctype = document.createElement("OPTION");
		el_acctype.value = accounts[x];
		el_acctype.innerHTML = accounts[x];
		el_account.appendChild(el_acctype);
		el_acctype = null;
	}
	
	el_remove.href = "javascript: paypal_removePackageForm("+ x_pack +");";
	el_remove.innerHTML = "Delete";
	
	td_duration.appendChild(el_duration);
	td_durtype.appendChild(el_durtype);
	td_cost.appendChild(el_cost);
	td_account.appendChild(el_account);
	td_remove.appendChild(el_remove);
	
	tr.appendChild(td_duration);
	tr.appendChild(td_durtype);
	tr.appendChild(td_cost);
	tr.appendChild(td_account);
	tr.appendChild(td_remove);
	
	new Insertion.Bottom(tbl, tr);
	//tbl.appendChild(tr);


*/	
	//Effect.toggle("paypal_pack_"+ x_pack);
}

function paypal_removePackageForm(ctr) {
	el = $('paypal_pack_'+ctr);
	Effect.toggle(el);
	el.parentNode.removeChild(el);
}