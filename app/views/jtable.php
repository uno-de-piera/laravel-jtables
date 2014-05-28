<html>
  <head>

    <link href="themes/black-tie/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
	<link href="Scripts/jtable/themes/metro/purple/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
	<div id="PeopleTableContainer" style="width: 900px;"></div>
	<script type="text/javascript">

		$(document).ready(function () 
		{
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Table of people',
				paging: true,
				sorting: true,
				actions: {
					listAction: 'getData/list',
					createAction: 'getData/create',
					updateAction: 'getData/update',
					deleteAction: 'getData/delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					Name: {
						title: 'Author Name',
						width: '40%'
					},
					Age: {
						title: 'Age',
						width: '20%'
					},
					RecordDate: {
						title: 'Record date',
						width: '30%',
						type: 'date',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
 
  </body>
</html>