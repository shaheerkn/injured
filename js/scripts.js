AOS.init();

const options = {
  threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
        const priceElement = entry.target;
        const targetValue = priceElement.getAttribute('data-value');
        
        if (targetValue === "Confidential") {
            setTimeout(() => {
                priceElement.textContent = "$Confidential";
            }, 1000);
            observer.unobserve(priceElement);
            return;
        }
        
        const targetNumber = parseInt(targetValue, 10);
        let startValue = 0;
        const duration = 2000; // ms
        const startTime = performance.now();
        
        function updateCount(currentTime) {
            const elapsedTime = currentTime - startTime;
            
            if (elapsedTime < duration) {
                const progress = elapsedTime / duration;
                const currentValue = Math.floor(progress * targetNumber);
                priceElement.textContent = '$' + currentValue.toLocaleString();
                requestAnimationFrame(updateCount);
            } else {
                priceElement.textContent = '$' + targetNumber.toLocaleString();
                observer.unobserve(priceElement);
            }
        }
        
        requestAnimationFrame(updateCount);
    }
  });
}, options);

document.querySelectorAll('.price').forEach(price => {
  observer.observe(price);
});