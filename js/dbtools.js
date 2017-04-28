function userTypesSelectList(callBackFunct) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	};
	x.open("POST", "php/reqrouter.php", false);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("task=3");
};

function restaurantSelectList(callBackFunct) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    };
    x.open("POST", "php/reqrouter.php", false);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("task=6");
    console.log("request sent");
}
function db_RestaurantIDAndNameList(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	};
	if (async === undefined) {
		async = true;
	}
	x.open("GET", "php/RestaurantNameAndIDList.php", async);
	x.send();
}

function db_LocationIDAndNameList(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	};
	if (async === undefined) {
		async = true;
	}
	x.open("GET", "php/LocationIDAndNameList.php", async);
	x.send();
}

function db_StateCodeList(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	};
	if (async === undefined) {
		async = true;
	}
	x.open("GET", "php/StateCodeList.php", async);
	x.send();
}
function db_AddLocation(callBackFunct,rid, name, country, state, city, addr, zip, phone, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	};
	x.open("POST", "php/AddLocation.php", false);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("restid="+rid+"&name="+name+"&country="+country+"&state="+state+"&city="+city+"&addr="+addr+"&zip="+zip+"&phone="+phone);
}
function locationSelectList(callBackFunct, name) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    };
    x.open("POST", "php/reqrouter.php", false);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("task=1&name="+name);
}

function db_AddEntree(callBackFunct, name, desc, price, locid, elemID, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        	elemID === undefined ? callBackFunct(this) : callBackFunct(this,elemID);
        }
    };
    x.open("POST", "php/add_entree.php", async);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("name=" + name + "&description=" + desc + "&price=" + price + "&locid=" + locid);
}

//sends request to signup.php to insert a new user into the database
function signUp(callBackFunct, name, email, type, password, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("POST", "php/signup.php", async);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("name=" + name + "&email=" + email + "&type=" + type + "&password=" + password);
}

//login user, sets various cookies relevant to valid user
function login(callBackFunct, username, password, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("POST", "php/userlogin.php", async);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("username=" + username + "&password=" + password);
}

//sends request for formated user table
function db_UserTable(callBackFunct, elemID, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        	elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("POST", "php/get_user_table.php", async);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send();
}

function db_UserSummaryTable(callBackFunct, elemID, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        	elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("GET", "php/userSummaryTable.php", async);
    x.send();

}

function db_EntreeTable(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "php/getEntreeTable.php", async);
	x.send();
}

function db_LocationTable(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "php/getLocationTable.php", async);
	x.send();
}
function getLocEntreeSummaryTable(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "php/locEntreeSummaryTable.php",async);
	x.send();
}

function db_TableDescription(callBackFunct, tableName, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("POST", "php/describeTable.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("table_name=" + tableName);
}

function db_RestaurantMinLocationTable(callBackFunct,minval, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this,elemID);
		}
	}
	x.open("GET", "php/getRestaurantMinLocationTable.php?minval="+minval, async);
	x.send();
}

function getRestIDList_HasLocs(callBackFunct) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	x.open("GET", "php/getRestIDList_HasLocs.php",false);
	x.send();
}


function db_AddEntreeClassColumn(callBackFunct) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	x.open("GET", "php/AddEntreeClassColumn.php", false);
	x.send();
}

function db_DeleteEntreeClassColumn(callBackFunct) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	x.open("GET", "php/DeleteEntreeClassColumn.php", false);
	x.send();
}

function getLocIDList_RestIDOnly(callBackFunct, restID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("POST", "php/getLocIDList_RestIDOnly.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("restID="+restID);
}

function db_CreateEntreeView(callBackFunct, locID, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this,elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("POST", "php/createEntreeView.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("locID=" + locID);
}


function db_CreateLocEntreeView(callBackFunct, locID, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("POST", "php/CreateLocEntreeView.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("locID=" + locID);
}

function db_CreateEntreeClassTable(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "php/CreateEntreeClassTable.php", async);
	x.send();
}

function db_DeleteEntreeClassTable(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "php/DeleteEntreeClassTable.php", async);
	x.send();
}

function db_Tables(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === undefined) {
		async = true;
	}
	x.open("GET", "php/getTables.php", async);
	x.send();
}

function db_DropView(callBackFunct, viewName, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === undefined) {
		async = true;
	}
	x.open("POST", "php/DropView.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("viewName="+viewName);
}

function db_ShowViews(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === undefined) {
		async = true;
	}
	x.open("GET", "php/ShowViews.php", async);
	x.send();
}