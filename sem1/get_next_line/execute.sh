make -C libft/ fclean && make -C libft/
clang -Wall -Werror -Wextra -I libft/includes -o get_next_line.o -c get_next_line.c
clang -Wall -Werror -Wextra -I libft/includes -o main.o -c main.c
clang -o test_gnl main.o get_next_line.o -I libft/includes -L libft/ -lft
