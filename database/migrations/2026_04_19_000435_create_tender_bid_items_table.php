<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tender_bid_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tender_bid_id')
                ->constrained('tender_bids');

            $table->foreignId('tender_boq_id')
                ->constrained('tender_boqs');

            $table->string('name');
            $table->decimal('unit_price', 14, 2);
            $table->decimal('total_price', 14, 2);

            $table->timestamps();

            $table->unique(['tender_bid_id', 'tender_boq_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_bid_items');
    }
};
