/**
 * 리스트에서 게시글 삭제
 * @returns 
 */
async function fnDel() {

    let checkboxes = document.querySelectorAll('.bbs_idx:checked');
    let code = document.getElementsByName('code')[0].value;

    let checkValues = [];

    checkboxes.forEach(function (checkbox) {
        checkValues.push(checkbox.value);
    });

    if (!checkValues.length) {
        alert("삭제할 리스트를 선택해주세요");
        return false;
    }
    if (confirm("삭제하시겠습니까? 삭제 후 복구가 불가능합니다.") == false) {
        return false;
    }
    try {
        // let url = "/adm/board/" + code + "/delete";
        let url = "./delete";
        const result = await fetch(url, {
            method: "POST",
            body: JSON.stringify(checkValues)
        });
        const res = await result.json();

        if (!res.result) {
            throw new Error(res.message);
        }
        alert(res.message);
        location.href = res.location;
    } catch (error) {
        alert(error.message);
    }
}
/**
 * 작성페이지에서 삭제 핸들러
 * @param {string} code 삭제할 게시글 코드
 * @param {int} delIdx 삭제할 게시글 idx
 * @returns 
 */
async function handleInfoDelete(code, delIdx) {
    if (confirm("삭제하시겠습니까?\r\n삭제하시면 복구가 불가능합니다.") == false) {
        return false;
    }

    try {
        const url = `../delete`;
        const result = await fetch(url, {
            method: "POST",
            body: JSON.stringify([delIdx]),
        });
        const res = await result.json();

        if (!res.result) {
            throw new Error(res.message);
        }
        alert(res.message);
        location.replace(res.location);
    } catch (error) {
        alert(error.message);
        return false;
    }

}
/**
 * 리스트페이지에서 삭제 핸들러
 * @param {string} code 삭제할 게시글 코드
 * @param {int} delIdx 삭제할 게시글 idx
 * @returns 
 */
async function handleInfoListDelete(code, delIdx) {
    if (confirm("삭제하시겠습니까?\r\n삭제하시면 복구가 불가능합니다.") == false) {
        return false;
    }

    try {
        const url = `./delete`;
        const result = await fetch(url, {
            method: "POST",
            body: JSON.stringify([delIdx]),
        });
        const res = await result.json();

        if (!res.result) {
            throw new Error(res.message);
        }
        alert(res.message);
        location.replace(res.location);
    } catch (error) {
        alert(error.message);
        return false;
    }

}


document.getElementById('getCheckedValuesButton')?.addEventListener('click', fnDel);

//////////////////////////////////////////////////////////////////////////////////////////////////////

async function handleSubmit(event) {
    event.preventDefault();

    const form = event.target;

    const formData = new FormData(form);
    try {
        let url = form.action;
        const result = await fetch(url, {
            method: "POST",
            body: formData
        });
        const res = await result.json();

        if (!res.result) {
            let errorMessage = {
                message: res.message,
                location: res.location,
            }
            throw new Error(JSON.stringify(errorMessage));
        }
        alert(res.message);
        if (res?.reload) {
            location.reload();
        } else {
            location.href = res.location;
        }
    } catch (error) {
        let obj = JSON.parse(error.message);
        alert(obj.message);
        if (obj.location) {
            location.href = obj.location;
        }
    }
}


document.querySelector("form[name='frm']")?.addEventListener("submit", handleSubmit);

///////////////////////////////////////////////////////////////////////////////

async function fnViewDel(code, idx) {

    let ViewIdx = [idx];

    try {
        let url = "/adm/board/" + code + "/delete";
        const result = await fetch(url, {
            method: "POST",
            body: JSON.stringify(ViewIdx)
        });
        const res = await result.json();

        if (!res.result) {
            throw new Error(res.message);
        }
        alert(res.message);
        location.href = res.location;
    } catch (error) {
        alert(error.message);
    }


}



///////////////////////////////////////////////////////////////////////////////
function Search() {

    let search_mode = document.querySelector('input[name="search_mode"]:checked').value;
    let search_word = document.getElementsByName('search_word')[0].value;
    let code = document.getElementsByName('code')[0].value;

    let url = "../../../adm/board/license/list?search_mode=" + search_mode + "&search_word=" + search_word + "&code=" + code;
    document.location = url;


}


///////////////////////////////////////////////////////////////////////////////

function CheckAll(checkBoxes, checked) {
    var i;
    if (checkBoxes.length) {
        for (i = 0; i < checkBoxes.length; i++) {
            checkBoxes[i].checked = checked;
        }
    } else {
        checkBoxes.checked = checked;
    }

}
/**
 * 우선순위 변경 핸들러
 * @returns 
 */
async function handleOnumChange() {
    if (confirm("우선순위를 변경하시겠습니까?") == false) {
        return false;
    }
    const form = document.querySelector("#lfrm");
    try {
        let url = "./onum";
        const formData = new FormData(form);
        const result = await fetch(url, {
            method: "POST",
            body: formData,
        });
        const response = await result.json();

        if (!response.result) {
            throw new Error(JSON.stringify(response));
        }
        alert(response.message);
        location.reload();
    } catch (error) {
        let obj = JSON.parse(error.message);
        alert(obj.message)
        if (obj?.location) {
            location.href = obj.location
        }
    }
}
document.getElementById("onumBtn")?.addEventListener("click", handleOnumChange);