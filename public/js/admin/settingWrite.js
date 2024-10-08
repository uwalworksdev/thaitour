function execDaumPostcode(frm_name, zip, addr1, addr2) {

    var of = document[frm_name];

    new daum.Postcode({
        oncomplete: function (data) {

            var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
            var extraRoadAddr = ''; // 도로명 조합형 주소 변수

            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
            // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
            if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                extraRoadAddr += data.bname;
            }
            // 건물명이 있고, 공동주택일 경우 추가한다.
            if (data.buildingName !== '' && data.apartment === 'Y') {
                extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
            }
            // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
            if (extraRoadAddr !== '') {
                extraRoadAddr = ' (' + extraRoadAddr + ')';
            }
            // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
            if (fullRoadAddr !== '') {
                fullRoadAddr += extraRoadAddr;
            }
            // 주소 정보를 해당 필드에 넣는다.


            of[zip].value = data.zonecode;
            of[addr1].value = fullRoadAddr;
            of[addr2].focus();

            /*
            frm.zip.value = data.zonecode;
            frm.addr1.value = fullRoadAddr;
            //document.getElementById("addr2").value = data.jibunAddress;
            frm.addr2.focus();
            */

            /*
            document.getElementById("sido").value = data.sido;;
            document.getElementById("gugun").value = data.sigungu;
            document.getElementById("dong").value = data.bname;;
            */



        }
    }).open();
}

async function handleSubmit(event) {
    event.preventDefault();
    const form = event.target;

    const formData = new FormData(form);
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    url.pathname += '/update';

    try {
        const result = await fetch(url.toString(), {
            method: "POST",
            body: formData,
        });
        const res = await result.json();
        if (!res.result) {
            throw new Error(res.message);
        }
        alert(res.message);
        location.reload();
    } catch (error) {
        alert(error.message);
        return false;
    }
}
/**
 * 엔터키 기능 막기
 * @param {*} event 
 */
function handleEnter(event) {
    if (event.code == 'Enter') {
        event.preventDefault();
    }
}
// 이벤트 부여
document.getElementById("frm").addEventListener("keydown", handleEnter)
document.getElementById("frm").addEventListener("submit", handleSubmit)