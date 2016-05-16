<script language="JavaScript">

function fillstate(id, name, comments, s, e){
		this.id = id;
		this.name = name;
		this.comments = comments;		
		this.s = s;
		this.e = e;				
}

function fillcity(id, name){
		this.id = id;
		this.name = name;
}

function newOption(value, text) {
		var Opt		= new Option();
		Opt.value	= value;
		Opt.text	= text;
		return Opt;
}	

function show_selected() {
		var form = document.forms.form1;
		var id = form.state.options[form.state.selectedIndex].value;
		if (id != '-1'){
			form.city.disabled = false;
			form.city.options.length = 1;
			for (i=states[id].s; i<states[id].e*1; i++){
				form.city.options.length += 1;
				form.city.options[form.city.options.length-1] = newOption(city[i].name, city[i].id);
			} 
		} else {
			form.city.disabled = true;		
			form.city.options.length=1;
		 }
	}

city = new Array()
states = new Array()

<?php

  $sql = 'SELECT StateID, name FROM states WHERE 1'; 
  $DataBase->query($sql);
  $nResult  = $DataBase->fetch_all();
  
  
  foreach($nResult as $val)
		{
			$SID    	= $val[0];
			$Name		= $val[1];
			
			// find the maximum CityID value
			$sql = "SELECT MAX(CityID) AS maximum FROM cities WHERE StateID = $SID";
			$DataBase->query($sql);
            $nResult0  = $DataBase->fetch_row();
			$maximum = $nResult0[maximum]+1;
			
			// find the minimum CityID value
			$sql = "SELECT MIN(CityID) AS minimum FROM cities WHERE StateID = $SID";
			$DataBase->query($sql);
            $nResult1  = $DataBase->fetch_row();
			$minimum = $nResult1[minimum];
			
			echo("states[$SID]= new fillstate('$SID', '$Name', '0', '$minimum', '$maximum');\n"); 

			$sql = "SELECT CityID, city FROM cities WHERE StateID=$SID"; 
			$DataBase->query($sql);
            $nResult2  = $DataBase->fetch_all();
			
			foreach($nResult2 as $vals)
		    {
			  $CID    	= $vals[0];
			  $City		= CheckString($vals[1]);
			  
			  $city = addslashes($City);
			  echo("city[$CID] = new fillcity('$City', '$CID');\n");
			}
			
          
         }// End OF Foreach Loop
		 
 
?>
</script>