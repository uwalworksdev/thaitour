async function handleDelete(idx) {
    if (confirm("삭제하시겠습니까?") == false) {
        return false;
    }

    try {
        let queryString = `idx[]=${encodeURIComponent(idx)}`
        const url = `./delete?${queryString}`;
        const result = await fetch(url);
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

async function handleSelectDelete() {
    let deleteArray = [];
    document.querySelectorAll('tbody input[name="idx[]"]').forEach(el => {
        if (el.checked) {
            deleteArray.push(el.value);
        }
    })
    try {
        if (deleteArray.length < 1) {
            throw new Error("삭제할 데이터가 없습니다.");
        }
        if (confirm("삭제하시겠습니까?") == false) {
            return false;
        }

        const queryString = deleteArray.map(itm => `idx[]=${encodeURIComponent(itm)}`).join("&");
        const url = `./delete?${queryString}`;
        const result = await fetch(url);
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
 * 리스트 전체 선택/해제
 * @param {boolean} bool 
 */
function handleCheck(bool) {
    document.querySelectorAll("tbody input[name='idx[]']").forEach(el => {
        el.checked = bool;
    })
}
/**
 * 상태값 변경 핸들러
 * @param {*} event 
 * @param {*} prevValue 초기 설정된 값
 * @returns 
 */
async function handleStatusChange(event, prevValue) {
    event.preventDefault();
    const idx = event.target.closest("tr").querySelector("input[name='idx[]']").value;
    const changeValue = event.target.value;
    if (confirm("상태값을 변경하시겠습니까?") == false) {
        event.target.value = prevValue;
        return false;
    }

    try {
        const result = await fetch("./status/change", {
            method: "POST",
            body: JSON.stringify({
                idx: idx,
                status: changeValue,
            }),
        });
        const res = await result.json();
        if (!res.result) {
            throw new Error(res.message);
        }
        alert(res.message);
        location.reload();
    } catch (error) {
        alert(error.message);
        event.target.value = prevValue;
    }
}
// 이벤트 부여
document.getElementById("selectDeleteBtn").addEventListener("click", handleSelectDelete);
document.querySelectorAll("tbody select[name='status']").forEach(el => {
    let prevValue = el.value;
    el.addEventListener("change", async function (event) {
        await handleStatusChange(event, prevValue)
    });
})
document.getElementById("allCheckTrueBtn").addEventListener('click', function (event) {
    handleCheck(true);
})
document.getElementById("allCheckFalseBtn").addEventListener('click', function (event) {
    handleCheck(false);
})