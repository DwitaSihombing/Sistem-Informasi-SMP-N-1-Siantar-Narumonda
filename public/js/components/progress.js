class ComponentsProgress{constructor(){this._initProgressBars()}_initProgressBars(){document.querySelectorAll(".progress-bar").forEach((r=>{const s=r.getAttribute("aria-valuenow");r.style.width=s+"%"}))}}