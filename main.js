let isDisabled = false;


// #region Click events
document.addEventListener('click', e => {
	const target = e.target;

	// On single post
	if (target.closest('.edg-vcard-dls-example :is(a, .elementor-icon)')) {
		e.preventDefault();
	}

	if (target.closest('.edg-vcard-dls-example :is(a, .elementor-icon)') && !isDisabled) {
		isDisabled = true;
		const postId = edgData.currPostId;
		edgVcardDls('edg_vcard_dls_example', postId);
	}

	// On JetEngine listing item of single post
	if (target.closest('.edg-vcard-dls-li-example :is(a, .elementor-icon)')) {
		e.preventDefault();
	}

	if (target.closest('.edg-vcard-dls-li-example :is(a, .elementor-icon)') && !isDisabled) {
		isDisabled = true;
		const postId = target.closest('.jet-listing-grid__item').dataset.postId;
		edgVcardDls('edg_vcard_dls_example', postId);
	}
});
// #endregion Click events


// #region vCard downloads
function edgVcardDls(action, postId) {
	const xhr = new XMLHttpRequest();
	const url = edgData.ajaxUrl;
	const data = `action=${action}&id=${postId}`;

	xhr.open('POST', url, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded', 'charset=utf-8');

	xhr.onload = () => {
		const res = JSON.parse(xhr.responseText);

		if (!res) {
			alert('vCard konnte nicht generiert werden. Bitte lade die Seite neu und versuche es nochmal.');
			isDisabled = false;
			return;
		}

		location.href = res.fileUrl;
		isDisabled = false;
	}

	xhr.onerror = () => {
		alert('Du bist wahrscheinlich offline.');
		isDisabled = false;
	}

	xhr.send(data);
}
// #endregion vCard downloads
