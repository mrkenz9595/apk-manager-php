#!/bin/bash

upload_dir="uploads"
output_file="apk_info.txt"

# Xóa file output nếu tồn tại
[ -f "$output_file" ] && rm "$output_file"

# Đảm bảo không có lỗi khi không có file .apk nào
shopt -s nullglob

# Mảng để chứa kết quả
declare -a results

if [[ -d "$upload_dir" ]]; then
  for apk_file in "$upload_dir"/*.apk; do
    filename=$(basename "$apk_file")
    
    # Lấy thông tin APK
    info=$(aapt dump badging "$apk_file" 2>/dev/null)
    
    if [[ $? -eq 0 ]]; then
      package=$(echo "$info" | awk -F"'" '/package: name=/{print $2}')
      version=$(echo "$info" | awk -F"'" '/package: name=/{print $6}')
      
      if [[ -n "$package" && -n "$version" ]]; then
        results+=("$package $version $filename")
      else
        results+=("Lỗi: Không thể lấy thông tin từ file: $filename")
      fi
    else
      results+=("Lỗi: Lệnh aapt thất bại với file: $filename")
    fi
  done

  # Ghi file nếu có kết quả
  if [[ ${#results[@]} -gt 0 ]]; then
    printf "%s\n" "${results[@]}" | sort -u > "$output_file"
    echo "✅ Done. Kết quả được lưu trong $output_file"
  else
    echo "⚠️ Không có file .apk hợp lệ nào trong thư mục uploads."
  fi
else
  echo "❌ Thư mục uploads không tồn tại."
fi
