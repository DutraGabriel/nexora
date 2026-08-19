document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.querySelector("[data-menu-toggle]");
    const mobileMenu = document.querySelector("[data-mobile-menu]");
    const menuOpenIcon = document.querySelector("[data-menu-open-icon]");
    const menuCloseIcon = document.querySelector("[data-menu-close-icon]");

    menuToggle?.addEventListener("click", () => {
        const isExpanded = menuToggle.getAttribute("aria-expanded") === "true";

        menuToggle.setAttribute("aria-expanded", String(!isExpanded));
        menuToggle.setAttribute("aria-label", isExpanded ? "Abrir menu" : "Fechar menu");
        mobileMenu?.classList.toggle("hidden", isExpanded);
        menuOpenIcon?.classList.toggle("hidden", !isExpanded);
        menuCloseIcon?.classList.toggle("hidden", isExpanded);
    });

    /*
    |--------------------------------------------------------------------------
    | Dados do produto
    |--------------------------------------------------------------------------
    */

    const productData = document.querySelector("#product-data");

    let variants = [];

    if (productData) {
        try {
            variants = JSON.parse(productData.dataset.variants || "[]");
        } catch (error) {
            console.error(
                "Não foi possível carregar as variantes do produto:",
                error,
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Galeria de imagens
    |--------------------------------------------------------------------------
    */

    const mainImage = document.querySelector("#main-product-image");
    const thumbnails = document.querySelectorAll(".product-thumbnail");

    thumbnails.forEach((thumbnail) => {
        thumbnail.addEventListener("click", () => {
            if (!mainImage) {
                return;
            }

            const image = thumbnail.dataset.image;
            const alt = thumbnail.dataset.alt || "";

            if (!image) {
                return;
            }

            mainImage.src = image;
            mainImage.alt = alt;

            thumbnails.forEach((item) => {
                item.classList.remove(
                    "border-gray-900",
                    "ring-2",
                    "ring-gray-900",
                );

                item.classList.add("border-gray-200");
            });

            thumbnail.classList.remove("border-gray-200");

            thumbnail.classList.add(
                "border-gray-900",
                "ring-2",
                "ring-gray-900",
            );
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Seleção de atributos
    |--------------------------------------------------------------------------
    */

    const attributeOptions = document.querySelectorAll(".attribute-option");

    const selectedValues = new Map();

    /*
    |--------------------------------------------------------------------------
    | Encontrar variante correspondente
    |--------------------------------------------------------------------------
    */

    function findMatchingVariant() {
        const selectedIds = Array.from(selectedValues.values())
            .map(Number)
            .sort((a, b) => a - b);

        if (selectedIds.length === 0) {
            return null;
        }

        return (
            variants.find((variant) => {
                const variantIds = (variant.attribute_value_ids || [])
                    .map(Number)
                    .sort((a, b) => a - b);

                if (variantIds.length !== selectedIds.length) {
                    return false;
                }

                return variantIds.every(
                    (id, index) => id === selectedIds[index],
                );
            }) || null
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Atualizar variante selecionada
    |--------------------------------------------------------------------------
    */

    function updateVariantDisplay() {
        const variant = findMatchingVariant();

        const variantContainer = document.querySelector("#selected-variant");

        const variantName = document.querySelector("#selected-variant-name");

        const variantSku = document.querySelector("#selected-variant-sku");

        const offerCards = document.querySelectorAll(".offer-card");

        /*
        |--------------------------------------------------------------------------
        | Nenhuma variante encontrada
        |--------------------------------------------------------------------------
        */

        if (!variant) {
            if (variantContainer) {
                variantContainer.classList.add("hidden");
            }

            offerCards.forEach((card) => {
                card.classList.remove("ring-2", "ring-gray-900", "opacity-40");
            });

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Mostrar variante
        |--------------------------------------------------------------------------
        */

        if (variantContainer) {
            variantContainer.classList.remove("hidden");
        }

        if (variantName) {
            variantName.textContent = variant.name || "";
        }

        if (variantSku) {
            variantSku.textContent = variant.sku ? `SKU: ${variant.sku}` : "";
        }

        /*
        |--------------------------------------------------------------------------
        | Destacar ofertas da variante
        |--------------------------------------------------------------------------
        */

        offerCards.forEach((card) => {
            const cardVariantId = Number(card.dataset.variantId);

            if (cardVariantId === Number(variant.id)) {
                card.classList.remove("opacity-40");

                card.classList.add("ring-2", "ring-gray-900");
            } else {
                card.classList.add("opacity-40");

                card.classList.remove("ring-2", "ring-gray-900");
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Eventos dos atributos
    |--------------------------------------------------------------------------
    */

    attributeOptions.forEach((option) => {
        option.addEventListener("click", () => {
            const attributeId = option.dataset.attributeId;
            const valueId = option.dataset.valueId;
            const value = option.dataset.value;

            if (!attributeId || !valueId) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Remover seleção visual do mesmo atributo
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    `.attribute-option[data-attribute-id="${attributeId}"]`,
                )
                .forEach((button) => {
                    button.classList.remove(
                        "border-gray-900",
                        "bg-gray-900",
                        "text-white",
                    );

                    button.classList.add(
                        "border-gray-300",
                        "bg-white",
                        "text-gray-700",
                    );
                });

            /*
            |--------------------------------------------------------------------------
            | Marcar opção selecionada
            |--------------------------------------------------------------------------
            */

            option.classList.remove(
                "border-gray-300",
                "bg-white",
                "text-gray-700",
            );

            option.classList.add(
                "border-gray-900",
                "bg-gray-900",
                "text-white",
            );

            /*
            |--------------------------------------------------------------------------
            | Guardar valor selecionado
            |--------------------------------------------------------------------------
            */

            selectedValues.set(attributeId, valueId);

            /*
            |--------------------------------------------------------------------------
            | Atualizar texto do atributo
            |--------------------------------------------------------------------------
            */

            const selectedLabel = document.querySelector(
                `#selected-attribute-${attributeId}`,
            );

            if (selectedLabel) {
                selectedLabel.textContent = value || "";
            }

            /*
            |--------------------------------------------------------------------------
            | Procurar variante
            |--------------------------------------------------------------------------
            */

            updateVariantDisplay();
        });
    });
});
