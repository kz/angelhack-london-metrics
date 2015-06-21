
var routes = {

	"/": {
		controller: "Index", 
		view: "index"
	},
	"/error": {
		controller: "Error", 
		error: "404", 
		view: "error"
	}

}