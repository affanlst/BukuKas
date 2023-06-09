function updateClock(clockElement) {
    // Mengambil waktu saat ini
    var currentTime = new Date();
  
    // Format jam, menit, dan detik
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
  
    // Tambahkan angka 0 di depan jam, menit, dan detik jika angkanya kurang dari 10
    hours = addZeroPadding(hours);
    minutes = addZeroPadding(minutes);
    seconds = addZeroPadding(seconds);
  
    // Menampilkan waktu dalam format jam digital (misalnya: 12:34:56)
    clockElement.textContent = hours + ":" + minutes + ":" + seconds;
  
    // Memanggil fungsi updateClock setiap detik (setiap 1000 milidetik)
    setTimeout(function () {
      updateClock(clockElement);
    }, 1000);
  }
  
  function addZeroPadding(number) {
    if (number < 10) {
      return "0" + number;
    }
    return number;
  }
  