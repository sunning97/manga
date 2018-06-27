<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mytime = Carbon\Carbon::now();

        $genres = ['16+','18+','Action','Adult','Adventure','Anime','Comedy','Comic','Doujinshi','Drama','Ecchi','Event BT','Fantasy','Game','Gender Bender','Harem','Historical','Horror','Isekai/Dị giới/Trọng sinh','Josei','Live action','Magic','manga','Manhua','Manhwa','Martial Arts','Mature','Mecha','Mystery','Nấu Ăn','NTR','One shot','Psychological','Romance','School Life','Sci-fi','Seinen','Shoujo','Shoujo Ai','Shounen','Shounen Ai','Slice of life','Smut','Soft Yaoi','Soft Yuri','Sports','Supernatural','Tạp chí truyện tranh','Tragedy','Trap (Crossdressing)','Trinh Thám','Truyện scan','Video Clip','VnComic','Webtoon','Yuri','Truyện full'];

        $des = [
            'Thể loại này nhẹ hơn 18+ và chỉ có cảnh ecchi nặng chứ không có cảnh nhạy cảm giường chiếu',
            'Là thể loại có nhiều cảnh nóng, đề cập đến các vấn đề nhạy cảm giới tính hay các cảnh bạo lực máu me .... Nói chung là truyện có tác động xấu đến tâm sinh lý của những độc giả chưa đủ 18 tuổi',
            'Thể loai này thường có nội dung về đánh nhau, bạo lực, hỗn loạn, với diễn biến nhanh.',
            'Thể loại có đề cập đến nhiều vấn đề nhạy cảm, không chỉ riêng chuyện tình dục, mà còn có thể có nhiều yếu tố như bạo lực, kinh dị thái quá, hoặc ảnh hưởng đến các nhận định đúng sai của chúng ta, cần phải là người đã trưởng thành để tránh bị ảnh hưởng xấu',
            'Thể loại phiêu lưu, mạo hiểm, thường là hành trình của các nhân vật.',
            'Những chuyện đã được chuyển thành Amine.',
            'Thể loại có nội dung trong sáng và cảm động, thường có tình tiết gây cười, xung đột nhẹ nhàng.',
            'Truyện tranh Châu Âu và Châu Mĩ.',
            'Thể loại truyện được phóng tác do fan hay có thể cả những Mangaka khác với tác giả truyện gốc. Tác giả vẽ Doujinshi thường dựa trên những nhân vật gốc để viết ra những câu chuyện theo sở thích của mình.',
            'Thể loại mang đến cho người xem những cảm xúc khác nhau: buồn bã, căng thẳng thậm chí là bi phẫn',
            'Thường có những tình huống nhạy cảm nhẹ nhàng nhằm lôi cuốn người xem',
            'Các truyện trong đây là các truyện tham gia event dịch truyện trả lương do Blogtruyen.com phát động, nhằm quảng bá blogtruyen đến đông độc giả hơn, hỗ trợ chi phí cho nhóm dịch, và giúp độc giả có nhiều đầu truyện hay với tần suất update rất mạnh (do các nhóm có kinh phí hoạt động)',
            'Thể loại xuất phát từ trí tưởng tượng phong phú, từ pháp thuật đến thế giới trong mơ thậm chí là những câu chuyện thần tiên',
            'Gồm những truyện có nội dung nói về game, hoặc lấy bối cảnh là game, hoặc nhân vật chính là nhân vật trong các game nổi tiếng, Hoặc có cốt truyện về nhân vật chính lạc vào một thế giới có hệ thống phân cấp độ, chia class, đánh quái vật lượm đồ, nâng cấp skill ....',
            'Là một thể loại trong đó giới tính của nhân vật bị lẫn lộn: nam hoá thành nữ, nữ hóa thành nam... (Không chọn thể loại này cho truyện TRAP nhé)',
            'Thể loại truyền tình cảm, lãng mạn mà trong đó nhiều nhân vật nữ thích một nam nhân vật chính.',
            'Thể loại có liên quan đến thời xa xưa.',
            'Horror = rùng rợn, nghe cái tên là biết thể loại này có nội dung như thế nào. Nó làm cho bạn kinh hãi, khiếp sơ, ghê tởm, có thể gây sock - một loại không dùng cho người yếu tim.',
            'Truyện có nhân vật chính đi từ thế giới này qua thế giới khác (thế giới fantasy, thế giới cổ đại, thế giới game ...) Nguyên nhân thường do bị triệu hồi, do chết rồi được hồi sinh, do lỗ hổng không gian ....',
            'Là một thể loại của manga hay anime được sáng tác chủ yếu bởi phụ nữ cho những độc giả nữ từ 18 đến 30. Josei manga có thể miêu tả những lãng mạn thực tế , nhưng trái ngược với hầu hết các kiểu lãng mạn lí tưởng của Shoujo manga với cốt truyện rõ ràng, chín chắn.',
            'Truyện đã được chuyển thể thành phim.',
            'Là thể loại liên quan đến phép thuật như là sức mạnh siêu nhiên hay gậy phép và vòng tròn ma thuật',
            'Các bộ truyện tranh Nhật bản',
            'Truyện tranh Trung Quốc.',
            'Truyện tranh Hàn Quốc, đọc từ trái sang phải.',
            'Giống với tên gọi, bất cứ gì liên quan đến võ thuật trong truyện từ các trận đánh nhau, tự vệ đến các môn võ thuật như akido, karate, judo hay taekwondo, kendo, các cách né tránh.',
            'Thể loại dành cho lứa tuổi 17+ bao gồm các pha bạo lực, máu me, chém giết, tình dục ở mức độ vừa.',
            'Mecha, còn được biết đến dưới cái tên meka hay mechs, là thể loại nói tới những cỗ máy biết đi (thường là do phi công cầm lái).',
            'Thể loại thường xuất hiện những điều bí ấn không thể lí giải được và sau đó là những nỗ lực của nhân vật chính nhằm tìm ra câu trả lời thỏa đáng.',
            'Nội dung về đầu bếp, các món ăn',
            'NTR (Netorare) là những truyện có nội dung nói về một cô gái nào đó mà nam chính yêu say đắm, nhưng cô ấy bị những nhân vật phụ hoặc phản diện chiếm đoạt. Một số truyện nặng đô thì nhân vật nữ có thể bị hãm hiếp, nặng hơn nữa thì nhân vật nữ ấy trở nên nghiện luôn việc xxx với nhân vật phụ đó ...',
            'Những truyện ngắn, thường là 1 chapter.',
            'Thể loại liên quan đến những vấn đề về tâm lý của nhân vật ( tâm thần bất ổn, điên cuồng ...)',
            'Thường là những câu chuyện về tình yêu. Ớ đây chúng ta sẽ lấy ví dụ như tình yêu giữa một người con trai và con gái, bên cạnh đó đặc điểm thể loại này là kích thích trí tưởng tượng của bạn về tình yêu.',
            'Trong thể loại này, ngữ cảnh diễn biến câu chuyện chủ yếu ở trường học.',
            'Bao gồm những chuyện khoa học viễn tưởng, đa phần chúng xoay quanh nhiều hiện tượng mà liên quan tới khoa học, công nghệ, tuy vậy thường thì những câu chuyện đó không gắn bó chặt chẽ với các thành tựu khoa học hiện thời, mà là do con người tưởng tượng ra.',
            'Là một thể loại của manga thường nhằm vào những đối tượng nam 18 đến 30 tuổi, nhưng người xem có thể lớn tuổi hơn, với một vài bộ truyện nhắm đến các doanh nhân nam quá 40. Thể loại này có nhiều phong cách riêng biệt , nhưng thể loại này có những nét riêng biệt, thường được phân vào những phong cách nghệ thuật rộng hơn và phong phú hơn về chủ đề, có các loại từ mới mẻ tiên tiến đến khiêu dâm.',
            'Đối tượng hướng tới của thể loại này là phái nữ. Nội dung của những bộ manga này thường liên quan đến tình cảm lãng mạn, chú trọng đầu tư cho nhân vật (tính cách,...).',
            'Thể loại quan hệ hoặc liên quan tới đồng tính nữ, thể hiện trong các mối quan hệ trên mức bình thường giữa các nhân vật nữ trong các manga, anime.',
            'Đối tượng hướng tới của thể loại này là phái nam. Nội dung của những bộ manga này thường liên quan đến đánh nhau và/hoặc bạo lực (ở mức bình thường, không thái quá).',
            'Là một thể loại của anime hoặc manga có nội dung về tình yêu giữa những chàng trai trẻ, mang tính chất lãng mạn nhưng ko đề cập đến quan hệ tình dục.',
            'Nói về cuộc sống đời thường.',
            'Những truyện có nội dung hơi nhạy cảm, đặc biệt là liên quan đến tình dục',
            'Boy x Boy. Nặng hơn Shounen Ai tí.',
            'Girl x Girl. Nặng hơn Shoujo Ai tí.',
            'Đúng như tên gọi, những môn thể thao như bóng đá, bóng chày, bóng chuyền, đua xe, cầu lông,... là một phần của thể loại này.',
            'Thể hiện những sức mạnh đáng kinh ngạc và không thể giải thích được, chúng thường đi kèm với những sự kiện trái ngược hoặc thách thức với những định luật vật lý.',
            'Tạp chí online về manga anime v.v...',
            'Thể loại chứa đựng những sự kiện mà dẫn đến kết cục là những mất mát hay sự rủi ro to lớn.',
            'Tương tự thể loại gender bender, nhưng khác ở chỗ giới tính nhân vật ko bị đảo lộn, chỉ đảo lộn ở cách ăn mặc, dáng vẻ ... nói chung là vẻ bề ngoài',
            'Các truyện có nội dung về các vụ án, các thám tử cảnh sát điều tra ...',
            'Các truyện được scan lên.',
            'Video clip',
            'Truyện tranh Việt Nam!',
            'Là thể loại do hàn quốc khởi xướng, hầu hết webtoon đều full màu, thể loại này có trang truyện bố cục khung hình theo chiều dọc, vì vậy xem trên máy vi tính, điện thoại, máy tính bảng ... đem lại cảm giác cực kỳ thoải mái',
            'Thể loại có liên quan đến tình cảm nữ-nữ (Girls Love -ガールズラブ gāruzu rabu?). Ttruyện có thể thể hiện trong các mối quan hệ trên mức bình thường giữa các nhân vật nữ trong các manga, anime. Đây là thể loại khá nhạy cảm, vậy các bạn nên cân nhắc khi xem. tốt nhất trên 18+',
            'Những truyện đã hoàn thành'
        ];


        for($i = 0;$i< count($genres);$i++){
            DB::table('genres')->insert([
                ['name'=>$genres[$i],'slug_name'=>str_slug($genres[$i]),'description'=>$des[$i],'created_at'=>$mytime->toDateTimeString(),'updated_at'=>$mytime->toDateTimeString()],
            ]);
        }

    }
}
