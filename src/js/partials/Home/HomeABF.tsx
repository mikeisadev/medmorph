declare module 'three'

import * as THREE from 'three'
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

// HTML Elements
let _3DModel_URL = 'https://medmorph.test/wp-content/3dmodels/dna2.glb'
const _3DViewer_Root: HTMLElement = document.querySelector('#abf-3d-viewer') as HTMLElement

// ThreeJS
let model, mixer: any // Init 

const loader = new GLTFLoader()

const scene = new THREE.Scene()
const camera = new THREE.PerspectiveCamera( 70, 590 / 557, 0.01, 2000 );

const renderer = new THREE.WebGLRenderer({alpha: true})
// scene.background = new THREE.Color();

renderer.setClearColor(0x000000, 0)
renderer.setSize( window.innerWidth, window.innerHeight )

const dlight0 = new THREE.DirectionalLight( 0xffffff, 4 );
const dlight1 = new THREE.DirectionalLight( 0xffffff, 4 );
const dlight2 = new THREE.DirectionalLight( 0xffffff, 4 );
const dlight3 = new THREE.DirectionalLight( 0xffffff, 4 );
const dlight4 = new THREE.DirectionalLight( 0xffffff, 4 );
const dlight5 = new THREE.DirectionalLight( 0xffffff, 4 );

dlight0.position.set(5000, 5000, 5000)
dlight1.position.set(-5000, -5000, -5000)
dlight2.position.set(5000, -5000, -5000)
dlight3.position.set(-5000, -5000, 5000)
dlight4.position.set(5000, -5000, 5000)
dlight5.position.set(-5000, -5000, -5000)

dlight0.visible = true
dlight1.visible = true
dlight2.visible = true
dlight3.visible = true
dlight4.visible = true
dlight5.visible = true

_3DViewer_Root.appendChild( renderer.domElement )

camera.position.set(0,0,0)
camera.lookAt(0,0,0)

// const hlp = new THREE.AxesHelper(1);
// scene.add(hlp);

const light1 = new THREE.PointLight( 0xffffff, 100000, 1 );
light1.position.set( 5000, 5000, 5000 );

const light2 = new THREE.PointLight( 0xffffff, 100000, 1 );
light2.position.set( -5000, -5000, -5000 );

const light3 = new THREE.PointLight( 0xffffff, 100000, 1 );
light3.position.set( 5000, 5000, -5000 );

const light4 = new THREE.PointLight( 0xffffff, 100000, 1 );
light4.position.set( -5000, 5000, 5000 );

const light5 = new THREE.PointLight( 0xffffff, 100000, 1 );
light5.position.set( -5000, -5000, 5000 );

const light6 = new THREE.PointLight( 0xffffff, 100000, 1 );
light6.position.set( 5000, -5000, -5000 );

light1.visible = true
light2.visible = true
light3.visible = true
light4.visible = true
light5.visible = true
light6.visible = true

scene.add(dlight0);
scene.add(dlight1);
scene.add(dlight2);
scene.add(dlight3);
scene.add(dlight4);
scene.add(dlight5);

scene.add(light1);
scene.add(light2);
scene.add(light3);
scene.add(light4);
scene.add(light5);
scene.add(light6);

// Load 3D Model From URL
loader.load(
    _3DModel_URL,
    (glb:any) => {
        console.log(glb)

        console.log(glb)

        const meshes: any[] = []

        model = glb.scene

        // const box = new THREE.Box3().setFromObject(model)
        // const center = box.getCenter(new THREE.Vector3())

        // model.position.x += (model.position.x - center.x)
        // model.position.y += (model.position.y - center.y)
        // model.position.z += (model.position.z - center.z)

        model.position.set(0.5, 1, 0)
            
        model.rotation.x = Math.PI/3
        model.rotation.y -= Math.PI/12
        model.rotation.z += Math.PI/4

        scene.add(model)

        mixer = new THREE.AnimationMixer(model)
        const clips = glb.animations

        console.log(clips, 'ANIMATIONS')

        if (clips && clips.length > 0) {
            const action = mixer.clipAction(clips[0])
            action.play()
        }

        model.traverse((child: any) => {
            if (child.isMesh) {
                meshes.push(child);
            }
        });

        meshes.forEach((mesh, index) => {
            console.log(`Part ${index}:`, mesh);
        });

        camera.position.z = 6

        camera.lookAt(0,0,0)

        renderer.setAnimationLoop(animate)

        function animate() {
            requestAnimationFrame(animate);
            if (mixer) mixer.update(clock.getDelta())
            
            //model.rotation.z += 0.001

        }
        renderer.render(scene, camera);
        
        const clock = new THREE.Clock()
        
        // animate();
    },
    (xhr: any) => {
        console.log( ( xhr.loaded / xhr.total * 100 ) + '% loaded' );
    },
    (error: any) => {
        console.log( error, error.body, 'An error happened' );
    }
)
