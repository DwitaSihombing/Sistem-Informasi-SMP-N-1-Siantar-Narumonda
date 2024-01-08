class Wizard{get options(){return{selected:0,cycle:!1,topNav:!0,lastEnd:!1,handleButtonClicks:!0,onNextClick:null,onPrevClick:null,onResetClick:null}}constructor(t,e={}){null!==t?(this.settings=Object.assign(this.options,e),this.element=t,this.links=this.element.querySelectorAll(".nav-tabs a"),this.buttonNext=this.element.querySelector(".btn-next"),this.buttonPrev=this.element.querySelector(".btn-prev"),this.buttonReset=this.element.querySelector(".btn-reset"),this.currentIndex=this.settings.selected,this.totalSteps=this.links.length,this._onNextClick=this._onNextClick.bind(this),this._onPrevClick=this._onPrevClick.bind(this),this._onResetClick=this._onResetClick.bind(this),this.steps=[],this._init()):console.log("Wizard element is null")}_init(){this._initSteps(),this._initTopNav(),this._addListeners(),this._showCurrent()}_initTopNav(){this.settings.topNav||this.element.querySelector(".nav-tabs").classList.add("disabled")}_initSteps(){this.steps=[];for(let t=0;t<this.totalSteps;t++)this.links[t].setAttribute("data-index",t),this.steps.push({link:this.links[t],done:!1})}_addListeners(){this.buttonNext&&this.buttonNext.addEventListener("click",this._onNextClick),this.buttonPrev&&this.buttonPrev.addEventListener("click",this._onPrevClick),this.buttonReset&&this.buttonReset.addEventListener("click",this._onResetClick);for(let t=0;t<this.totalSteps;t++)this.steps[t].link.addEventListener("click",this._onLinkClick.bind(this))}_onLinkClick(t){t.preventDefault(),this.settings.topNav&&(this.currentIndex=parseInt(t.currentTarget.getAttribute("data-index")),this._showCurrent())}_onNextClick(t){this.settings.handleButtonClicks&&this.gotoNext(),"function"==typeof this.settings.onNextClick&&this.settings.onNextClick()}_onPrevClick(t){this.settings.handleButtonClicks&&this.gotoPrev(),"function"==typeof this.settings.onPrevClick&&this.settings.onPrevClick()}_onResetClick(t){this.settings.handleButtonClicks&&this.reset(),"function"==typeof this.settings.onResetClick&&this.settings.onResetClick()}_showCurrent(){this._checkButtons(),this._checkPreviousOnes(),jQuery(this.steps[this.currentIndex].link).tab("show")}_checkPreviousOnes(){var t=this.currentIndex-1;for(let e=0;e<this.totalSteps;e++)e<=t&&(this.steps[e].done=!0,this.steps[e].link.classList.add("done"))}_uncheckAll(){for(let t=0;t<this.totalSteps;t++)this.steps[t].done=!1,this.steps[t].link.classList.remove("done")}_checkButtons(){this.settings.cycle||(this.currentIndex>=this.totalSteps-1?this.buttonNext&&this.buttonNext.classList.add("disabled"):this.buttonNext&&this.buttonNext.classList.remove("disabled"),this.currentIndex<=0?this.buttonPrev&&this.buttonPrev.classList.add("disabled"):this.buttonPrev&&this.buttonPrev.classList.remove("disabled"))}_disableButtons(){this.buttonNext&&(this.buttonNext.removeEventListener("click",this._onNextClick),this.buttonNext.classList.add("disabled")),this.buttonPrev&&(this.buttonPrev.removeEventListener("click",this._onPrevClick),this.buttonPrev.classList.add("disabled")),this.buttonReset&&(this.buttonReset.removeEventListener("click",this._onResetClick),this.buttonReset.classList.add("disabled"))}getCurrentIndex(){return this.currentIndex}getTotalSteps(){return this.totalSteps}getCurrentContent(){return this.element.querySelectorAll(".tab-pane")[this.currentIndex]}getContentByIndex(t){this.element.querySelectorAll(".tab-pane")[t]}gotoIndex(t){t>=this.totalSteps||t<0?console.error("Index out of bounds"):(this.currentIndex=t,this._showCurrent())}gotoNext(){this.currentIndex++,this.currentIndex>=this.totalSteps&&(this.settings.cycle?this.currentIndex=0:this.currentIndex--),this._showCurrent(),this.settings.lastEnd&&this.currentIndex===this.totalSteps-1&&this._disableButtons()}gotoPrev(){this.currentIndex--,this.currentIndex<0&&(this.settings.cycle?this.currentIndex=this.totalSteps-1:this.currentIndex++),this._showCurrent()}reset(){this._initSteps(),this.currentIndex=this.settings.selected,this._showCurrent(),this._uncheckAll()}}