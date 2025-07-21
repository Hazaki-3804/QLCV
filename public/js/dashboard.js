// HIỂN THỊ BẢN ĐỒ VỚI CÁC NHÂN VIÊN TRÊN DASHBOARD
document.addEventListener('DOMContentLoaded', async function () {
    const DISTANCE_THRESHOLD = 100; // mét
    let allMarkers = allData || []; // Dữ liệu từ server
    const markerMap = {}; // Object để lưu trữ ánh xạ marker theo ID

    // 1. Fetch dữ liệu từ server
    // try {
    //     const res = await fetch('/getEmployeeAndRequests', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         }
    //     });

    //     const data = await res.json();
    //     allMarkers = data.data.allData || [];
    //     console.log('✅ Dữ liệu từ server:', allMarkers);
    // } catch (error) {
    //     console.error('❌ Lỗi khi lấy dữ liệu từ server:', error);
    //     return;
    // }

    // 2. Hàm tính khoảng cách Haversine
    function haversineDistance(lat1, lng1, lat2, lng2) {
        const toRad = deg => deg * Math.PI / 180;
        const R = 6371e3; // Bán kính Trái Đất (m)

        const dLat = toRad(lat2 - lat1);
        const dLng = toRad(lng2 - lng1);
        const a = Math.sin(dLat / 2) ** 2 +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLng / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    // 3. Gán cờ "isCrowded" trước để tối ưu hiệu năng
    function updateCrowdedStatus() {
        allMarkers.forEach((item, i) => {
            item.isCrowded = false;
            for (let j = 0; j < allMarkers.length; j++) {
                if (i === j) continue;
                const d = haversineDistance(item.vi_do, item.kinh_do, allMarkers[j].vi_do, allMarkers[j].kinh_do);
                if (d < DISTANCE_THRESHOLD) {
                    item.isCrowded = true;
                    break;
                }
            }
        });
    }
    updateCrowdedStatus();

    // 4. Hàm hiển thị tooltip
    function buildTooltip(item) {
        const color = item.loai === 'employee'
            ? getStatusColor(item.trang_thai)
            : getRequestColor(item.trang_thai);

        const label = item.loai === 'employee' ? 'Kỹ thuật viên' : 'Khách hàng';
        const icon = item.loai === 'employee' ? '👨‍🔧' : '📌';

        return `
            <div class="tooltip-custom d-flex align-items-center gap-2">
                <img src="${item.anh_dai_dien}" alt="${item.ho_ten}" class="avatar-img" style="width: 40px; height: 40px; border-radius: 50%;">
                <div>
                    <div class="fw-semibold text-dark">${item.ho_ten}</div>
                    <div class="status-text" style="color:${color}">
                        ${icon} ${item.trang_thai}
                    </div>
                    <div class="badge ${item.loai === 'employee' ? 'bg-primary text-white' : 'bg-warning text-dark'} mt-1 px-2 py-1 rounded">
                        ${label}
                    </div>
                </div>
            </div>
        `;
    }

    function getStatusColor(status) {
        return status === "Trực tuyến" ? "green" : "#E65100";
    }

    function getRequestColor(status) {
        return status === "Chờ xử lý" ? "red" : "blue";
    }

    // 5. Hiển thị bản đồ Leaflet
    const map = L.map('map').setView([10.762622, 106.660172], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const markerCluster = L.markerClusterGroup();

    // 6. Hàm tạo marker
    function createMarker(item) {
        const tooltipHtml = buildTooltip(item);

        const marker = L.marker([item.vi_do, item.kinh_do], {
            icon: L.divIcon({
                html: `
                    <div style="
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        overflow: hidden;
                        border: 3px solid ${item.loai === 'employee' ? '#007bff' : '#ffc107'};
                        box-shadow: 0 0 6px rgba(0,0,0,0.3);
                        background-color: #fff;
                    ">
                        <img src="${item.anh_dai_dien}" 
                             alt="${item.ho_ten}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                `,
                className: '',
                iconSize: [40, 40],
                iconAnchor: [20, 20]
            })
        });

        // Gán tooltip dựa trên trạng thái isCrowded
        if (!item.isCrowded) {
            marker.bindTooltip(tooltipHtml, {
                permanent: true,
                direction: 'top',
                className: 'leaflet-tooltip-own',
                interactive: true
            });
            marker._tooltipVisible = true;
        } else {
            marker._tooltipVisible = false;
        }

        // Toggle tooltip khi click
        marker.on('click', function () {
            if (marker._tooltipVisible) {
                marker.unbindTooltip();
                marker._tooltipVisible = false;
            } else {
                marker.bindTooltip(tooltipHtml, {
                    permanent: true,
                    direction: 'top',
                    className: 'leaflet-tooltip-own',
                    interactive: true
                }).openTooltip();
                marker._tooltipVisible = true;
            }
        });

        return marker;
    }

    // 7. Khởi tạo các marker ban đầu
    allMarkers.forEach(item => {
        const marker = createMarker(item);
        const key = `${item.loai}_${item.id}`; // ✅ FIX KEY
        markerMap[key] = marker;
        markerCluster.addLayer(marker);
    });

    map.addLayer(markerCluster);

    // 8. Hàm cập nhật vị trí marker
    function updatePositionsFromArray(dataArray) {
        let hasAnyChange = false;

        dataArray.forEach(item => {
            const { id, loai, vi_do, kinh_do } = item;
            const key = `${loai}_${id}`;
            const index = allMarkers.findIndex(m => m.id === id && m.loai === loai);

            if (index !== -1) {
                // ✅ Cập nhật vị trí
                allMarkers[index].vi_do = vi_do;
                allMarkers[index].kinh_do = kinh_do;
            } else {
                // 🆕 Thêm mới
                const newItem = {
                    id,
                    loai,
                    ho_ten: item.ho_ten || "Chưa rõ",
                    trang_thai: item.trang_thai || "Không rõ",
                    anh_dai_dien: item.anh_dai_dien || "default.png",
                    vi_do,
                    kinh_do
                };
                allMarkers.push(newItem);
            }

            hasAnyChange = true;
        });

        if (hasAnyChange) {
            // 🧠 Tính lại crowded sau khi cập nhật allMarkers
            updateCrowdedStatus();

            // 🧼 Xóa tất cả marker cũ
            Object.values(markerMap).forEach(marker => {
                markerCluster.removeLayer(marker);
            });
            Object.keys(markerMap).forEach(key => delete markerMap[key]);

            // 🚀 Thêm lại marker mới với isCrowded cập nhật
            allMarkers.forEach(item => {
                const key = `${item.loai}_${item.id}`;
                const newMarker = createMarker(item);
                markerMap[key] = newMarker;
                markerCluster.addLayer(newMarker);
            });
        }
    }

    // 9. Xóa một marker theo ID
    function removeMarkerById(loai, id) {
        const key = `${loai}_${id}`;

        // 1. Xóa khỏi mảng allMarkers
        const index = allMarkers.findIndex(m => m.id === id && m.loai === loai);
        if (index !== -1) {
            allMarkers.splice(index, 1);
        }

        // 2. Xóa marker khỏi bản đồ
        const marker = markerMap[key];
        if (marker) {
            markerCluster.removeLayer(marker);
            delete markerMap[key];
        }

        // 3. Cập nhật lại crowded status (tùy chọn)
        updateCrowdedStatus();
    }

    // 10. Giả lập cập nhật dữ liệu sau 5 giây
    setInterval(() => {
        const updatedItems = allMarkers.map(item => ({
            ...item,
            vi_do: item.vi_do + (Math.random() - 0.5) * 0.01,
            kinh_do: item.kinh_do + (Math.random() - 0.5) * 0.01
        }));

        console.log('🔄 Cập nhật dữ liệu:', updatedItems);
        updatePositionsFromArray(updatedItems);
    }, 5000);

    // TEST 2
    // setInterval(() => {
    //     const updatedItems = [];

    //     // ✅ 50% khả năng là thêm mới một nhân viên
    //     if (Math.random() < 0.5) {
    //         const newId = Math.floor(Math.random() * 10000); // Tạo ID ngẫu nhiên
    //         const newEmployee = {
    //             id: newId,
    //             ho_ten: `Nhân viên ${newId}`,
    //             trang_thai: "Trực tuyến",
    //             vi_do: 10.75 + Math.random() * 0.1,
    //             kinh_do: 106.65 + Math.random() * 0.1,
    //             anh_dai_dien: "./assets/img/vnpt.jpg",
    //             loai: "employee",
    //             isCrowded: false
    //         };
    //         updatedItems.push(newEmployee);
    //         console.log('🆕 Thêm nhân viên mới:', newEmployee);
    //     }

    //     // ✅ 50% còn lại: cập nhật vị trí nhân viên hiện có
    //     allMarkers.forEach(item => {
    //         if (item.loai === "employee") {
    //             const updatedItem = {
    //                 ...item,
    //                 vi_do: item.vi_do + (Math.random() - 0.5) * 0.01,
    //                 kinh_do: item.kinh_do + (Math.random() - 0.5) * 0.01
    //             };
    //             updatedItems.push(updatedItem);
    //         }
    //     });

    //     console.log('🔄 Cập nhật dữ liệu:', updatedItems);
    //     updatePositionsFromArray(updatedItems);
    // }, 5000);
});