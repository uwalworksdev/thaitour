<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<style>
        #iframeContainer {
            width: 100%;
            height: 235vh;
            display: flex;
            flex-direction: column;
        }

        #iframeContainer::-webkit-scrollbar {
            display: none;
        }

        iframe {
            width: 100%;
            height: 100%;
            flex: 1;
            border: none;
        }

        iframe::-webkit-scrollbar {
            display: none;
        }

        @media screen and (max-width: 850px) {
            #iframeContainer {
                height: 260vh;
            }
        }

        @media screen and (max-width: 600px) {
            #iframeContainer {
                height: 290vh;
            }
        }

        @media screen and (max-width: 480px) {
            #iframeContainer {
                height: 250vh;
            }
        }
</style>
    <div id="iframeContainer">
        <iframe id="myIframe" src="https://tourlab.toursafe.co.kr/" frameborder="0" width="100%" ></iframe>
    </div>
<?php $this->endSection(); ?>