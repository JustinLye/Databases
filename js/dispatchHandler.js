//Every question in the selection box will have a page handler
function PageHandler(selectOptVal) {
	this.optionValue = selectOptVal;
}
PageHandler.prototype.generate = function () { alert('Page handler generate function is not defined'); }
PageHandler.prototype.clean = function () { alert('Page handler clean function is not defined'); };

function DispatchHandler() {
	this.previousPage = "";
	this.pageHandlers = [];
	this.InsertPageHandler = function (optVal, genFunct, clnFunct) {
		var p = new PageHandler(optVal);
		p.generate = genFunct;
		p.clean = clnFunct;
		this.pageHandlers.push(p);
	}
	this.GeneratePage = function (optVal) {
		for (let i = 0; i < this.pageHandlers.length; i++) {
			if (this.pageHandlers[i].optionValue === optVal) {
				this.CleanPage();
				this.previousPage = optVal;
				this.pageHandlers[i].generate();
				return true;
			}
		}
		return false;
	}
	this.CleanPage = function () {
		if (this.previousPage !== "") {
			for (let i = 0; i < this.pageHandlers.length; i++) {
				if (this.pageHandlers[i].optionValue === this.previousPage) {
					this.pageHandlers[i].clean();
				}
			}
		}
	}
}
