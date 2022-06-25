// FETCH DATA
var orderField="id";
var order=1;
var pageSize=5;
var currentPage=0;
function loadData()
{
	pageSizeEl=document.getElementById("recordsPerPage");
	if(pageSize!=pageSizeEl.options[pageSizeEl.selectedIndex].value)
	{
		pageSize=pageSizeEl.options[pageSizeEl.selectedIndex].value;
		currentPage=0;
	}

	//get number item on the page:
	var req="order="+orderField+"&orderType="+order+"&pageSize="+pageSize+"&page="+currentPage;
	if(document.getElementById('id').value.length>0)
		req+="&id="+document.getElementById('id').value;

		if(document.getElementById('containerid').value.length>0)
		req+="&containerid="+document.getElementById('containerid').value;

		if(document.getElementById('locationid').value.length>0)
		req+="&locationid="+document.getElementById('locationid').value;

	if(document.getElementById('plusorminus').value.length>0)
		req+="&plusorminus="+document.getElementById('plusorminus').value;


	fetch('fetchA1.php?'+req).then((res) => res.json())
	.then(response => {
	  console.log(response);
	  let output = '';
	  for(let i in response){
		output += `<tr>
			<td>${response[i].id}</td>
			<td>${response[i].containerid}</td>
			<td>${response[i].locationid}</td>
			<td>${response[i].plusorminus}</td>
		</tr>`;
	  }

	  document.querySelector('.tbody').innerHTML = output;
	}).catch(error = console.log(error));
}

function changeOrder(name,type){
	//change previous header to standard:
	var hrefItem=document.getElementById('td_'+orderField);
	var value=orderField;

	if(name==orderField)
	{
		if(order==1)
		{
			hrefItem.innerHTML = "&#8600;";
			hrefItem.onclick = function() {changeOrder(value,-1);};
		}
	    else{
		  hrefItem.innerHTML = "&#8599;";
		  hrefItem.onclick = function() {changeOrder(value,1);};
		}
		order=-order;
	}
    else
	{
		//reset old link:
		hrefItem.innerHTML = "&#8600;";
		hrefItem.onclick = function() {changeOrder(value,1);};
		var hrefItem=document.getElementById('td_'+name);
		hrefItem.innerHTML = "&#8599;";
		hrefItem.onclick = function() {changeOrder(name,-1);};
		orderField=name;
		order=1;
	}
	currentPage=0;
	loadData();
}

function changePage(changePage){
	currentPage+=changePage;
	if(currentPage<0)
		currentPage=0;
	loadData();
}


//set listener on press button "Enter" for each input:
var inputs = document.querySelectorAll('input[type=text]');
for (var i = 0; i < inputs.length; i++) {
    var self = inputs[i];

    self.onkeypress = function(e){
		if(e.key=='Enter')
		{
			currentPage=0;
			loadData();
		}
	};
}



loadData();

