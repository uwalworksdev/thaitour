

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-animation');

    cards.forEach((card, index) => {
        const startDirection = index % 2 === 0 ? -200 : 200;
        const endDirection = index % 2 === 0 ? -100 : 100;

        card.style.setProperty('--start-x', `${startDirection}px`);
        card.style.setProperty('--end-x', `${endDirection}px`);
        card.style.animationDelay = `${index * 0.2}s`;
        card.style.visibility = 'hidden'; // 기본은 숨김 상태

        function checkScroll() {
            const cardRect = card.getBoundingClientRect();
            const windowHeight = window.innerHeight || document.documentElement.clientHeight;

            // 카드가 화면 안에 들어온 경우
            if (cardRect.top < windowHeight && cardRect.bottom > 0) {
                if (card.style.visibility !== 'visible') {
                    card.style.visibility = 'visible';
                    card.style.animation = 'none'; // 리셋
                    void card.offsetWidth; // 강제 리플로우 (리셋 효과)
                    card.style.animation = ''; // 다시 애니메이션 실행
                }
            } else {
                // 화면 밖이면 숨김
                card.style.visibility = 'hidden';
            }
        }

        window.addEventListener('scroll', checkScroll);
        checkScroll(); // 페이지 로드시 초기 체크
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // 시간대별 탭 전환
    const tabButtons = document.querySelectorAll('.bg-gray-50 .bg-white button');
    const tabContent = document.querySelector('.bg-gray-50 .p-6');
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // 모든 버튼 스타일 초기화
            tabButtons.forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700', 'hover:bg-gray-100');
            });
            // 클릭된 버튼 스타일 변경
            this.classList.remove('bg-white', 'text-gray-700', 'hover:bg-gray-100');
            this.classList.add('bg-primary', 'text-white');
            // 탭 내용 변경 (실제로는 AJAX 요청이나 다른 방식으로 내용을 변경할 수 있음)
            const timeSlot = this.querySelector('span').textContent;
            tabContent.querySelector('h3').textContent = timeSlot + ' 추천 코스';
        });
    });
});
document.addEventListener("DOMContentLoaded", () => {
    // 슬라이드 관련 기존 코드
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".slider-dot");
    let current = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
            slide.style.opacity = i === index ? "1" : "0";
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle("bg-white", i === index);
            dot.classList.toggle("bg-white/50", i !== index);
        });
        current = index;
    }

    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => showSlide(index));
    });

    function nextSlide() {
        let next = (current + 1) % slides.length;
        showSlide(next);
    }

    showSlide(current);
    setInterval(nextSlide, 6000);

    // 가이드북 보기 버튼 스크롤
    const guideButton = document.querySelector('.main_title');
    guideButton.addEventListener('click', () => {
        const featuresSection = document.querySelector('.section-best');
        featuresSection.scrollIntoView({ behavior: 'smooth' });
        locationCardEvent(); // 이 때도 동작
    });

    // 👇 추가: 스크롤 감지
    observeLocationCards();
});

function locationCardEvent() {
    const cards = document.querySelectorAll('.location-card');

    cards.forEach(card => {
        card.classList.remove('show'); // 초기화
    });

    setTimeout(() => {
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('show');
            }, index * 200);
        });
    }, 100);
}

function observeLocationCards() {
    const targetSection = document.querySelector('.section-best'); // location-card들이 들어있는 영역
    if (!targetSection) return;

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                locationCardEvent(); // 화면에 보이면 실행
            }
        });
    }, {
        threshold: 0.3 // 30% 정도 보이면 트리거
    });

    observer.observe(targetSection);
}

const hotelData = {
    "luxury-hotel": [
        { title: "카펠라 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2425", imgSrc: "/event/images/카펠라 방콕.jpg" },
        { title: "신돈 켐핀스키 호텔 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2199", imgSrc: "/event/images/신돈 켐핀스키.webp" },
        { title: "포 시즌스 호텔 방콕 앳 차오프라야 리버", href: "https://thetourlab.com/product-hotel/hotel-detail/2335", imgSrc: "/event/images/포시즌 방콕.jpg" },
        { title: "리츠칼튼 호텔", href: "https://thetourlab.com/product-hotel/hotel-detail/2482", imgSrc: "/event/images/리츠칼튼 방콕.jpg" },
    ],
    "residence-hotel": [
        { title: "에스콧 엠바시 사톤", href: "https://thetourlab.com/product-hotel/hotel-detail/2207", imgSrc: "/event/images/에스콧 엠바시.jpg" },
        { title: "샤마 레이크뷰 아속 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2426", imgSrc: "/event/images/샤마 레이크뷰 아속 방콕.webp" },
        { title: "차트리움 레지던스 사톤", href: "https://thetourlab.com/product-hotel/hotel-detail/2427", imgSrc: "/event/images/차트리움 사톤.jpg" },
        { title: "오리엔탈 레지던스 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2428", imgSrc: "/event/images/오리엔탈 레지던스.jpg" },
    ],
    "good-price-hotel": [
        { title: "홀리데이 인 방콕 실롬", href: "https://thetourlab.com/product-hotel/hotel-detail/2429", imgSrc: "/event/images/홀리데이인 실롬.jpg" },
        { title: "더 살릴 호텔 리버사이드 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2398", imgSrc: "/event/images/살릴 리버사이드.jpg" },
        { title: "노보텔 방콕 수쿰빗 20", href: "https://thetourlab.com/product-hotel/hotel-detail/2434", imgSrc: "/event/images/노보텔 방콕 수쿰빗 20.avif" },
        { title: "이비스 스타일 방콕 실롬", href: "https://thetourlab.com/product-hotel/hotel-detail/2431", imgSrc: "/event/images/이비스 실롬.jpg" },
        { title: "유 사톤 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2338", imgSrc: "/event/images/유 사톤.jpg" },
        { title: "코모 메트로폴리탄 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2432", imgSrc: "/event/images/코모 메트로폴리탄.jpg" },
        { title: "에스콧 사톤 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2330", imgSrc: "/event/images/에스콧 엠바시 사톤.webp" },
        { title: "아노마 그랜드 호텔 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2483", imgSrc: "/event/images/아모나 그랜드.jpg" },
    ],
    "infinitypool-hotel": [
        { title: "137 필라스 스위트, & 레지던스 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2299", imgSrc: "/event/images/137 필라스 스위트, & 레지던스 방콕.webp" },
        { title: "아바니 플러스 방콕 리버사이드 호텔", href: "https://thetourlab.com/product-hotel/hotel-detail/2282", imgSrc: "/event/images/아바니 플러스 방콕 리버사이드 호텔.webp" },
        { title: "호텔 인디고 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2484", imgSrc: "/event/images/호텔 인디고.jpg" },
        { title: "소 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2242", imgSrc: "/event/images/소 방콕.jpg" },
    ],
    "shopping-hotel": [
        { title: "파크 하얏트 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2290", imgSrc: "/event/images/파크 하얏트 방콕.jpg" },
        { title: "그랑데 센터 포인트 터미널 21 호텔 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2295", imgSrc: "/event/images/그랑데 센터포인트 21.jpg" },
        { title: "시암 캠핀스키 호텔", href: "https://thetourlab.com/product-hotel/hotel-detail/2264", imgSrc: "/event/images/시암 켐핀스키 호텔2.jpg" },
        { title: "엠포리움 스위트 바이 차트리움", href: "https://thetourlab.com/product-hotel/hotel-detail/2297", imgSrc: "/event/images/엠포리움 스위트.jpg" },
    ],
    "pet-hotel": [
        { title: "킴튼 말라이 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2394", imgSrc: "/event/images/킴튼 말라이.jpg" },
        { title: "더 스탠다드 방콕 마하나콘", href: "https://thetourlab.com/product-hotel/hotel-detail/2223", imgSrc: "/event/images/더 스탠다드 방콕 마하나콘.webp" },
        { title: "스테이브릿지 스위트 방콕 통로", href: "https://thetourlab.com/product-hotel/hotel-detail/2433", imgSrc: "/event/images/스테이브리지 통로.jpg" },
        { title: "더 수코타이 방콕", href: "https://thetourlab.com/product-hotel/hotel-detail/2304", imgSrc: "/event/images/수코타이.jpg" },
    ],
    "tour-1": [ // 반일 투어
        { title: "담넌사두억 수상 시장 & 위험한 기찻길 시장 반일 투어", href: "https://thetourlab.com/product-tours/item_view/2437", imgSrc: "/event/images/담넌사두억&위험한기찻길 반일.jpg" },
        { title: "아유타야 방파인 & 아트뮤지엄 오전 반일 투어", href: "https://thetourlab.com/product-tours/item_view/2438", imgSrc: "/event/images/아유타야 방파인 반일.jpg" },
        { title: "암파와 주말시장 & 반딧불 반일 투어", href: "https://thetourlab.com/product-tours/item_view/2439", imgSrc: "/event/images/암퍼와.jpg" },
        { title: "고대도시 무앙보란 반일 투어", href: "https://thetourlab.com/product-tours/item_view/2440", imgSrc: "/event/images/무앙보란.jpg" },
        { title: "아유타야 선셋 리버크루즈 반일 투어", href: "https://thetourlab.com/product-tours/item_view/2419", imgSrc: "/event/images/아유타야+선셋+리버크루즈+반일.jpg" },
        { title: "딸랏노이 감성 골목 반일 투어", href: "https://thetourlab.com/product-tours/item_view/2441", imgSrc: "/event/images/딸랏노이 반일.jpg" },
    ],
    "tour-2": [ // 하루 투어
        { title: "담넌사두억 위험한시장 & 왕궁 전일 투어", href: "https://thetourlab.com/product-tours/item_view/2442", imgSrc: "/event/images/담넌&왕궁 일일.jpg" },
        { title: "아유타야 & 방파인 여름궁전 전일 투어", href: "https://thetourlab.com/product-tours/item_view/2443", imgSrc: "/event/images/아유타야 일일.jpeg" },
        { title: "스리아유타야 라이언 파크 & 선셋 전일 투어", href: "https://thetourlab.com/product-tours/item_view/2444", imgSrc: "/event/images/스리아유타야 라이언 파크 & 선셋 전일 투어.webp" },
        { title: "칸차나부리 코끼리 & 뗏목트래킹 전일 투어", href: "https://thetourlab.com/product-tours/item_view/2445", imgSrc: "/event/images/칸차나부리 일일.jpeg" },
    ],
    "tour-3": [ // 단독 투어
        { title: "연꽃정원 & 톤부리 마켓 반일 단독 투어", href: "https://thetourlab.com/product-tours/item_view/2446", imgSrc: "/event/images/연꽃정원 단독.jpeg" },
        { title: "아유타야 선셋 반일 단독 투어", href: "https://thetourlab.com/product-tours/item_view/2447", imgSrc: "/event/images/아유타야 선셋 단독.jpeg" },
        { title: "칸차나부리 & 에라완 국립공원 전일 단독 택시 투어", href: "https://thetourlab.com/product-tours/item_view/2448", imgSrc: "/event/images/칸차나부리 에라완 단독.jpeg" },
        { title: "에라완 국립 공원 & 록밸리 허브 온천 전일 단독 택시 투어", href: "https://thetourlab.com/product-tours/item_view/2449", imgSrc: "/event/images/에라완 국립 공원 & 록밸리 허브 온천 전일 단독 택시 투어.png" },
    ],
    "tour-4": [ // 스파&마사지
        { title: "렛츠 릴렉스 그랑데 센터 포인트 호텔 플런칫", href: "https://thetourlab.com/product-spa/spa-details/2450", imgSrc: "/event/images/렛츠 릴렉스 그랑데 센터 포인트 호텔 플런칫.webp" },
        { title: "오아시스 스파 방콕 31", href: "https://thetourlab.com/product-spa/spa-details/2451", imgSrc: "/event/images/오아시스 스파.jpeg"},
        { title: "디바나 센츄라 스파", href: "https://thetourlab.com/product-spa/spa-details/2452", imgSrc: "/event/images/디바나 센츄라 스파.webp" },
        { title: "헬스랜드 스파 & 마사지 아속", href: "https://thetourlab.com/product-spa/spa-details/2453", imgSrc: "/event/images/헬스랜드 스파 & 마사지 아속.png" },
    ],
    "tour-5": [ // 디너 크루즈
        { title: "차오프라야 프린세스 선셋/디너 크루즈", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2454", imgSrc: "/event/images/차오프라야_프린세스.jpeg" },
        { title: "샹그릴라 호라이즌 디너크루즈", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2455", imgSrc: "/event/images/샹그릴라+호라이즌+디너크루즈.jpeg" },
        { title: "화이트 오키드 리버 크루즈", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2456", imgSrc: "/event/images/화이트 오키드 디너크루즈.jpeg" },
        { title: "반얀트리 호텔 압사라 디너 크루즈", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2457", imgSrc: "/event/images/반얀트리 호텔 압사라 디너 크루즈.webp" },
    ],
    "tour-6": [ // 쿠킹 스쿨
        { title: "실롬 타이쿠킹 스쿨", href: "https://thetourlab.com/product-tours/item_view/2458", imgSrc: "/event/images/실롬타이쿠킹.jpeg" },
        { title: "망고 쿠킹 스쿨", href: "https://thetourlab.com/product-tours/item_view/2459", imgSrc: "/event/images/망고 쿠킹.jpeg" },
        { title: "솜퐁 타이 쿠킹스쿨", href: "https://thetourlab.com/product-tours/item_view/2460", imgSrc: "/event/images/솜퐁 타이쿠킹.jpeg" },
        { title: "팅글리 타이 쿠킹 스쿨", href: "https://thetourlab.com/product-tours/item_view/2461", imgSrc: "/event/images/팅글리 쿠킹.jpeg" },
    ],
    "tour-7": [ // 레스토랑
        { title: "반얀트리 방콕 버티고 (Vertigo) 레스토랑 세트 메뉴", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2462", imgSrc: "/event/images/반얀트리 레스토랑.jpeg" },
        { title: "블루 엘리펀트 레스토랑 런치 & 디너 세트 방콕", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2463", imgSrc: "/event/images/블루엘리펀트 레스토랑.jpeg" },
        { title: "만다린 오리엔탈 방콕 살라 림 남 디너 코스", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2464", imgSrc: "/event/images/만다린 레스토랑.jpeg" },
        { title: "르부아 앳 스테이트 타워 시로코 레스토랑 세트 메뉴", href: "https://thetourlab.com/product-restaurant/restaurant-detail/2465", imgSrc: "/event/images/르부아 레스토랑.jpg" },
    ],
    "sub-1": [ // 베스트 셀러 골프장
        { title: "섬밋 윈드밀 골프 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2466", imgSrc: "/event/images/섬밋 윈드밀 골프 클럽.png" },
        { title: "무앙 깨우 골프 코스", href: "https://thetourlab.com/product-golf/golf-detail/2467", imgSrc: "/event/images/무앙깨우.jpg" },
        { title: "타나 시티 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2468", imgSrc: "/event/images/타나 시티.jpg" },
        { title: "수완 골프 앤 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2469", imgSrc: "/event/images/수완골프.jpg" },
        { title: "카스카타 골프 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2470", imgSrc: "/event/images/카스카타.jpg" },
        { title: "람 룩카 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2471", imgSrc: "/event/images/람 룩카 컨트리 클럽.webp" },
    ],
    "sub-2": [ // 럭셔리 골프장
        { title: "니칸티 골프 클럽", href: "https://thetourlab.com/product-golf/golf-detail/1916", imgSrc: "/event/images/니칸티.jpg" },
        { title: "타이 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2472", imgSrc: "/event/images/타이컨트리.jpg" },
        { title: "알파인 골프 앤 스포츠 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2473", imgSrc: "/event/images/알파인.jpg" },
        { title: "더 로얄 젬스 시티 골프 클럽 (랑싯)", href: "https://thetourlab.com/product-golf/golf-detail/2474", imgSrc: "/event/images/로얄 젬스 랑싯.jpg" },
    ],
    "sub-3": [ // 가성비 좋은 골프장
        { title: "파인허스트 골프 앤 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2417", imgSrc: "/event/images/파인허스트.jpg" },
        { title: "윈저 파크 앤 골프 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2475", imgSrc: "/event/images/윈저파크.jpg" },
        { title: "더 빈티지 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2476", imgSrc: "/event/images/빈티지.jpg" },
        { title: "플로라빌 골프 앤 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2477", imgSrc: "/event/images/플로라빌.jpg" },
        { title: "수파프룩 골프 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2478", imgSrc: "/event/images/수파프룩 골프 클럽.jpg" },
        { title: "더 파인 골프 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2479", imgSrc: "/event/images/더 파인 골프.jpg" },
        { title: "방파콩 리버사이드 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2480", imgSrc: "/event/images/방파콩 리버사이드.jpg" },
        { title: "에카차이 골프 앤 컨트리 클럽", href: "https://thetourlab.com/product-golf/golf-detail/2481", imgSrc: "/event/images/에카차이 골프 앤 컨트리 클럽.jpg" },
    ]
}
// View
function renderHotels(hotels, container) {
    hotels.forEach(hotel => {
        const hotelElement = document.createElement('a');
        hotelElement.href = hotel.href;
        hotelElement.className = `flex-1 min-w-[480px] max-w-[480px]`;
        hotelElement.innerHTML = `
      <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
        <div class="aspect-w-16 aspect-h-9">
          <img src="${hotel.imgSrc.replace(/ /g, "%20")}" alt="${hotel.imgAlt}" class="object-cover transition-transform duration-300 ease-in-out hover:scale-110" loading="lazy"/>
        </div>
        <div class="p-4">
          <h3 class="text-lg font-medium text-gray-900 mb-2">${hotel.title}</h3>
          ${hotel.price ? `<p class="text-right text-lg font-bold text-gray-900">${hotel.price}</p>` : ''}
        </div>
      </div>
    `;

        container.appendChild(hotelElement);
    });
}

// Controller
function init() {
    const containers = document.querySelectorAll('.hotel-list'); // 모든 호텔 리스트 찾기

    containers.forEach(container => {
        const key = container.dataset.id; // 각 div에 설정된 data-id 읽어옴
        const hotels = hotelData[key] || [];

        if (hotels.length > 0) {
            renderHotels(hotels, container);
        }
    });
}
// 실제 실행
document.addEventListener('DOMContentLoaded', init);