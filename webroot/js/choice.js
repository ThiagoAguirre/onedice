// Three.js D20 Icosahedron in vanilla JS
import * as THREE from 'https://unpkg.com/three@0.160.0/build/three.module.js';

const diceLayer = document.getElementById('dice-layer');

let renderer, scene, camera, diceGroup, clock;
let shellMaterial, innerMaterial, edges;

function initThree() {
  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(45, diceLayer.clientWidth / diceLayer.clientHeight, 0.1, 100);
  camera.position.set(0, 0, 6);

  renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setSize(diceLayer.clientWidth, diceLayer.clientHeight);
  renderer.outputColorSpace = THREE.SRGBColorSpace;
  diceLayer.appendChild(renderer.domElement);

  const ambient = new THREE.AmbientLight(0xffffff, 0.35);
  scene.add(ambient);
  // Neutral key light to avoid "lightsaber" look
  const keyLight = new THREE.PointLight(0xffffff, 0.9);
  keyLight.position.set(6, 6, 8);
  scene.add(keyLight);

  diceGroup = new THREE.Group();
  scene.add(diceGroup);

  // Geometry
  const geometry = new THREE.IcosahedronGeometry(1.15, 0);

  // Glass-like shell
  shellMaterial = new THREE.MeshPhysicalMaterial({
    color: new THREE.Color().setHSL(0.55, 0.7, 0.55), // teal-ish start
    roughness: 0.07,
    metalness: 0.0,
    transparent: true,
    transmission: 0.92,
    thickness: 0.6,
    ior: 1.28,
  });
  const shell = new THREE.Mesh(geometry, shellMaterial);
  diceGroup.add(shell);

  // Inner glow core
  innerMaterial = new THREE.MeshBasicMaterial({ color: 0x7dd3fc, transparent: true, opacity: 0.28 });
  const inner = new THREE.Mesh(new THREE.IcosahedronGeometry(0.9, 0), innerMaterial);
  diceGroup.add(inner);

  // Wireframe edges
  edges = new THREE.Mesh(new THREE.IcosahedronGeometry(1.18, 0), new THREE.MeshBasicMaterial({ color: 0x93c5fd, wireframe: true, transparent: true, opacity: 0.55 }));
  diceGroup.add(edges);

  // Slightly smaller overall
  diceGroup.scale.set(0.9, 0.9, 0.9);

  clock = new THREE.Clock();
  animate();
}

function animate() {
  const t = clock.getElapsedTime();
  diceGroup.rotation.y = t * 0.2;
  diceGroup.rotation.x = Math.sin(t * 0.3) * 0.1 + 0.3;
  diceGroup.position.y = Math.sin(t * 0.5) * 0.2;

  // Cool color cycle: teal -> violet -> teal
  const hue = 0.55 + 0.18 * Math.sin(t * 0.35); // 0.37..0.73
  const shellColor = new THREE.Color().setHSL(hue, 0.75, 0.55);
  shellMaterial.color.copy(shellColor);
  innerMaterial.color.copy(new THREE.Color().setHSL(hue, 0.6, 0.65));
  if (edges && edges.material) {
    edges.material.color.copy(new THREE.Color().setHSL(hue, 0.6, 0.7));
    edges.material.opacity = 0.5 + 0.1 * Math.sin(t * 0.8);
  }

  renderer.render(scene, camera);
  requestAnimationFrame(animate);
}

function onResize() {
  const w = diceLayer.clientWidth;
  const h = diceLayer.clientHeight;
  camera.aspect = w / h;
  camera.updateProjectionMatrix();
  renderer.setSize(w, h);
}

function randomizeParticles() {
  document.querySelectorAll('[data-particles] .particle').forEach((el, i) => {
    const left = 20 + Math.random() * 40; // 20% - 60%
    const top = 20 + Math.random() * 60;  // 20% - 80%
    el.style.left = left + '%';
    el.style.top = top + '%';
    el.style.animationDelay = (i * 0.3) + 's';
    el.style.animationDuration = (6 + Math.random() * 6) + 's';
  });
  document.querySelectorAll('[data-particles-right] .particle').forEach((el, i) => {
    const left = 40 + Math.random() * 40; // 40% - 80%
    const top = 20 + Math.random() * 60;  // 20% - 80%
    el.style.left = left + '%';
    el.style.top = top + '%';
    el.style.animationDelay = (i * 0.3) + 's';
    el.style.animationDuration = (6 + Math.random() * 6) + 's';
  });
}

function wireClicks() {
  document.getElementById('panel-player')?.addEventListener('click', () => {
    console.log('Player selected');
  });
  document.getElementById('panel-mestre')?.addEventListener('click', () => {
    console.log('Mestre selected');
  });
}

function wireTilt() {
  const maxDeg = 8;
  document.querySelectorAll('.role-panel').forEach(panel => {
    const content = panel.querySelector('.content');
    panel.addEventListener('mousemove', (e) => {
      const rect = panel.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width;  // 0..1
      const y = (e.clientY - rect.top) / rect.height;  // 0..1
      const rotY = (x - 0.5) * 2 * maxDeg; // -max..max
      const rotX = -(y - 0.5) * 2 * maxDeg;
      panel.style.transform = `perspective(800px) rotateX(${rotX}deg) rotateY(${rotY}deg)`;
      if (content) content.style.transform = 'translateZ(30px)';
    });
    panel.addEventListener('mouseleave', () => {
      panel.style.transform = '';
      if (content) content.style.transform = '';
    });
  });
}

function typeWriterInstruction() {
  const el = document.getElementById('instruction');
  if (!el) return;
  const text = el.textContent?.trim() || '';
  let i = 0;
  const speed = 50;
  function tick() {
    i++;
    el.textContent = text.slice(0, i);
    if (i < text.length) {
      setTimeout(tick, speed);
    }
  }
  el.textContent = '';
  setTimeout(tick, 500);
}

window.addEventListener('resize', onResize);

// Boot
initThree();
randomizeParticles();
wireClicks();
wireTilt();
typeWriterInstruction();
